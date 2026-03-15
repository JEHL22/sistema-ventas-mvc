<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Escandallo;
use App\Models\Material;
use App\Models\Estilo;
use App\Models\Cliente;
use App\Services\WhatsAppNotificationService;
use Illuminate\Http\Request;

/**
 * CONTROLADOR: OrdenTrabajoController
 * 
 * En el patrón MVC de Laravel, el Controlador es el "director de orquesta":
 * - Recibe la petición HTTP (Request)
 * - Delega la lógica al Modelo (Eloquent) o Servicios
 * - Devuelve una respuesta (View o JSON)
 * 
 * Este Controlador gestiona el ciclo completo de una Orden de Trabajo:
 * Crear → MRP (verificar materiales) → Calcular fecha (SAM) → Notificar WhatsApp → Actualizar estado.
 */
class OrdenTrabajoController extends Controller
{
    /**
     * INYECCIÓN DE DEPENDENCIAS: Le pedimos a Laravel que nos dé el Servicio de WhatsApp.
     * Laravel usa su "Container" de IoC para instanciar y entregarlo automáticamente.
     * Esto nos desacopla: si mañana cambiamos el proveedor de WhatsApp,
     * solo tocamos el Servicio, no este Controlador.
     */
    private WhatsAppNotificationService $whatsApp;

    public function __construct(WhatsAppNotificationService $whatsApp)
    {
        // Guardamos la instancia del servicio para usarla en todos los métodos del controlador
        $this->whatsApp = $whatsApp;
    }

    // ===========================================================
    // MÉTODO: index — Lista todas las órdenes de trabajo
    // ===========================================================
    public function index()
    {
        // with(['cliente', 'estilo']) = "Eager Loading" (carga ansiosa).
        // Carga las relaciones DE UNA VEZ para evitar el problema "N+1 queries"
        // (sin esto, por cada orden haría una consulta adicional para el cliente y otra para el estilo).
        $ordenes = OrdenTrabajo::with(['cliente', 'estilo'])
            ->latest() // ordena por 'created_at' descendente (la más nueva primero)
            ->paginate(15); // pagina de 15 en 15 para no sobrecargar la vista

        return view('ordenes.index', compact('ordenes'));
    }

    // ===========================================================
    // MÉTODO: create — Muestra el formulario para nueva orden
    // ===========================================================
    public function create()
    {
        // Cargamos los clientes y estilos para llenar los <select> del formulario
        $clientes = Cliente::orderBy('nombre')->get();
        $estilos = Estilo::orderBy('nombre_estilo')->get();

        return view('ordenes.create', compact('clientes', 'estilos'));
    }

    // ===========================================================
    // MÉTODO: store — Guarda la nueva orden + MRP + SAM + WhatsApp
    // ===========================================================
    public function store(Request $request)
    {
        // --- PASO 1: VALIDACIÓN ---
        // validate() revisa los datos del formulario. Si falla, redirige automáticamente
        // al formulario con los errores. Es la forma elegante de validar en Laravel.
        $datos = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'estilo_id' => 'required|exists:estilos,id',
            'cantidad_lote' => 'required|integer|min:1',
            'fecha_ingreso' => 'required|date',
        ]);

        // --- PASO 2: EXPLOSIÓN DE MATERIALES (MRP) ---
        // Antes de guardar la orden, verificamos si hay suficiente stock.
        [$hayStock, $deficitMateriales] = $this->calcularMRP(
            $datos['estilo_id'],
            $datos['cantidad_lote']
        );

        // --- PASO 3: CÁLCULO CIENTÍFICO DE FECHA DE ENTREGA (SAM) ---
        // Calculamos cuándo terminará el lote basándonos en los SAM de las operaciones.
        $fechaCompromiso = $this->calcularFechaCompromiso(
            $datos['estilo_id'],
            $datos['cantidad_lote'],
            $datos['fecha_ingreso']
        );

        // --- PASO 4: GUARDAR LA ORDEN ---
        // Mezclamos los datos validados con los calculados para crear la orden en la BD.
        $orden = OrdenTrabajo::create(array_merge($datos, [
            'fecha_compromiso' => $fechaCompromiso,
            'estado_actual' => 'Corte', // Siempre empieza en la etapa de Corte
        ]));

        // --- PASO 5: DESCONTAR STOCK (si hay suficiente) ---
        if ($hayStock) {
            $this->reservarStock($datos['estilo_id'], $datos['cantidad_lote']);
        }

        // --- PASO 6: NOTIFICACIONES WHATSAPP ---
        // Enviamos el mensaje de bienvenida siempre.
        $this->whatsApp->notificar($orden);

        // Si hay déficit, enviamos también la alerta de materiales al cliente.
        if (!$hayStock && !empty($deficitMateriales)) {
            $this->whatsApp->notificarDeficitMateriales($orden, $deficitMateriales);
        }

        // --- PASO 7: REDIRIGIR CON MENSAJES ---
        // with() pasa un mensaje "flash" a la sesión para mostrar en la vista.
        $mensaje = $hayStock
            ? 'Orden creada y stock reservado correctamente. 📦'
            : 'Orden creada ⚠️ con DÉFICIT de materiales. Se notificó al cliente vía WhatsApp.';

        return redirect()->route('ordenes.index')->with('success', $mensaje);
    }

    // ===========================================================
    // MÉTODO: show — Muestra detalle de una orden
    // ===========================================================
    public function show(OrdenTrabajo $orden)
    {
        // Laravel usa "Route Model Binding": al escribir OrdenTrabajo $orden como parámetro,
        // automáticamente hace la consulta WHERE id = {id_de_la_url} por nosotros. ¡Magia!
        $orden->load(['cliente', 'estilo.escandallos.material', 'produccionDiarias']);

        return view('ordenes.show', compact('orden'));
    }

    // ===========================================================
    // MÉTODO: actualizarEstado — Avanza la orden a la siguiente etapa
    // ===========================================================
    public function actualizarEstado(Request $request, OrdenTrabajo $orden)
    {
        $request->validate([
            'estado_actual' => 'required|in:Corte,Costura,Acabado,Entregado',
        ]);

        // Guardamos el nuevo estado
        $orden->update(['estado_actual' => $request->estado_actual]);

        // Disparamos la notificación automática según el nuevo estado
        $this->whatsApp->notificar($orden);

        return redirect()->route('ordenes.show', $orden)->with('success', 'Estado actualizado y cliente notificado. ✅');
    }

    // ===========================================================
    // MÉTODO PRIVADO: calcularMRP — Explosión de Materiales
    // ===========================================================
    /**
     * Verifica si hay suficiente stock para fabricar el lote.
     * 
     * @param int $estiloId      El estilo/prenda a fabricar.
     * @param int $cantidadLote  Cuántas unidades se quieren fabricar.
     * @return array [bool $hayStockSuficiente, array $deficitMateriales]
     */
    private function calcularMRP(int $estiloId, int $cantidadLote): array
    {
        // Traemos el escandallo (BOM) del estilo, incluyendo los materiales.
        // Con ->with('material') hacemos Eager Loading (una sola consulta JOIN).
        $escandallos = Escandallo::with('material')
            ->where('estilo_id', $estiloId)
            ->get();

        $hayStockSuficiente = true;
        $deficitMateriales = [];

        foreach ($escandallos as $escandallo) {
            // Calculamos el consumo total aplicando el porcentaje de merma:
            // consumo_total = cantidad_lote × consumo_por_prenda × (1 + merma/100)
            $mermaFactor = 1 + ($escandallo->porcentaje_merma / 100);
            $consumoTotal = $cantidadLote * $escandallo->cantidad_consumo * $mermaFactor;

            // Comparamos con el stock real disponible en la base de datos
            $stockDisponible = $escandallo->material->stock_total;

            if ($stockDisponible < $consumoTotal) {
                // Hay déficit: registramos cuánto falta
                $hayStockSuficiente = false;
                $deficitMateriales[] = [
                    'nombre' => $escandallo->material->descripcion,
                    'faltante' => round($consumoTotal - $stockDisponible, 2),
                    'unidad' => $escandallo->material->unidad_medida,
                ];
            }
        }

        return [$hayStockSuficiente, $deficitMateriales];
    }

    // ===========================================================
    // MÉTODO PRIVADO: reservarStock — Descuenta materiales del stock
    // ===========================================================
    /**
     * Descuenta el stock de los materiales tras confirmar que hay suficiente.
     */
    private function reservarStock(int $estiloId, int $cantidadLote): void
    {
        $escandallos = Escandallo::with('material')
            ->where('estilo_id', $estiloId)
            ->get();

        foreach ($escandallos as $escandallo) {
            $mermaFactor = 1 + ($escandallo->porcentaje_merma / 100);
            $consumoTotal = $cantidadLote * $escandallo->cantidad_consumo * $mermaFactor;

            // decrement() es un método de Eloquent que hace UPDATE ... SET stock_total = stock_total - X
            // Es atómico (seguro en entornos con múltiples usuarios) a diferencia de leer y luego guardar.
            $escandallo->material->decrement('stock_total', $consumoTotal);
        }
    }

    // ===========================================================
    // MÉTODO PRIVADO: calcularFechaCompromiso — Cálculo SAM
    // ===========================================================
    /**
     * Calcula la fecha estimada de entrega usando los SAM (minutos estándar).
     * 
     * Fórmula: Dias = (SAM_total × Cantidad_lote) / (Eficiencia_taller × Minutos_por_dia_laboral)
     * 
     * @param int    $estiloId      Estilo a fabricar
     * @param int    $cantidadLote  Número de prendas
     * @param string $fechaIngreso  Fecha de inicio (YYYY-MM-DD)
     * @return string               Fecha de compromiso calculada (YYYY-MM-DD)
     */
    private function calcularFechaCompromiso(int $estiloId, int $cantidadLote, string $fechaIngreso): string
    {
        // --- Constantes del taller (en el futuro se pueden sacar de un panel de configuración) ---
        $minutosLaboralesPerDia = 480; // 8 horas × 60 minutos = 480 min/día
        $eficienciaOculta = 0.75; // El taller opera al 75% de eficiencia estándar (vs teoría)

        // Calculamos el SAM total del estilo sumando los tiempos de TODAS sus operaciones.
        // NOTA: Actualmente 'operacions' es un catálogo genérico no ligado al estilo por FK.
        // Este cálculo asume un SAM de las operaciones globales del taller.
        // En una iteración futura se puede crear una tabla pivote estilo_operacion para mayor precisión.
        $samTotalMinutos = \App\Models\Operacion::sum('tiempo_sam_minutos');

        // Si no hay operaciones cargadas, usamos un mínimo de 1 minuto para no dividir entre 0
        if ($samTotalMinutos <= 0) {
            $samTotalMinutos = 1;
        }

        // Minutos reales totales = SAM × lote / eficiencia
        // La eficiencia reduce la "velocidad teórica" al rendimiento real del taller
        $minutosReales = ($samTotalMinutos * $cantidadLote) / $eficienciaOculta;

        // Convertimos a días laborables
        $diasNecesarios = ceil($minutosReales / $minutosLaboralesPerDia); // ceil() redondea hacia arriba

        // Calculamos la fecha final sumando días laborables (usando Carbon, incluido en Laravel)
        // Carbon es la librería de manipulación de fechas de Laravel (inspirada en Moment.js)
        $fechaCompromiso = \Carbon\Carbon::parse($fechaIngreso)->addWeekdays($diasNecesarios);

        return $fechaCompromiso->toDateString();
    }
}