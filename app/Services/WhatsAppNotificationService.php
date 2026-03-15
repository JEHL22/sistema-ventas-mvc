<?php

namespace App\Services;

use App\Models\OrdenTrabajo;
use Illuminate\Support\Facades\Log;

/**
 * SERVICIO: WhatsAppNotificationService
 * 
 * En Laravel, los "Services" (Servicios) son clases que encapsulan lógica
 * de negocio compleja que no pertenece ni al Controlador ni al Modelo.
 * Un Servicio ayuda a mantener los controladores "delgados" (thin controllers).
 * 
 * Este servicio centraliza el envío de notificaciones a los clientes vía WhatsApp.
 * Por ahora, envía los mensajes al Log de Laravel (storage/logs/laravel.log),
 * simulando la llamada a una API real (ej. Twilio, Meta Cloud API).
 */
class WhatsAppNotificationService
{
    /**
     * MÉTODO PRINCIPAL: Despacha la notificación correcta según el estado actual.
     * Funciona como un "router" de mensajes.
     * 
     * @param OrdenTrabajo $orden  La orden de trabajo que cambió de estado.
     */
    public function notificar(OrdenTrabajo $orden): void
    {
        // Cargamos las relaciones 'cliente' y 'estilo' si aún no están cargadas
        // (using 'loadMissing' evita consultas duplicadas a la base de datos)
        $orden->loadMissing(['cliente', 'estilo']);

        // Seleccionamos qué mensaje enviar según el nuevo estado
        match ($orden->estado_actual) {
                'Corte' => $this->enviarMensajeBienvenida($orden),
                'Costura' => $this->enviarActualizacionProgreso($orden, 'Corte', 'Costura', 25),
                'Acabado' => $this->enviarActualizacionProgreso($orden, 'Costura', 'Acabado', 75),
                'Entregado' => $this->enviarConfirmacionEntrega($orden),
                // No hacemos nada para estados desconocidos
                default => null,
            };
    }

    /**
     * Mensaje de bienvenida cuando la orden se crea y entra a 'Corte'.
     */
    private function enviarMensajeBienvenida(OrdenTrabajo $orden): void
    {
        $numero = $orden->cliente->celular_whatsapp;
        $cliente = $orden->cliente->nombre;
        $estilo = $orden->estilo->nombre_estilo;
        $lote = $orden->cantidad_lote;
        $entrega = $orden->fecha_compromiso;

        // Formateamos el mensaje con datos reales del pedido
        $mensaje = "¡Hola {$cliente}! 👋 Tu pedido de *{$lote} unidades* del estilo *{$estilo}* "
            . "ha sido registrado exitosamente. La fecha estimada de entrega es *{$entrega}*. ¡Gracias por confiar en nosotros!";

        $this->dispatch($numero, $mensaje);
    }

    /**
     * Mensaje de actualización de progreso (Corte→Costura o Costura→Acabado).
     */
    private function enviarActualizacionProgreso(OrdenTrabajo $orden, string $etapaAnterior, string $etapaActual, int $porcentaje): void
    {
        $numero = $orden->cliente->celular_whatsapp;
        $cliente = $orden->cliente->nombre;
        $estilo = $orden->estilo->nombre_estilo;

        $mensaje = "📦 Actualización de tu pedido, {$cliente}. "
            . "Tu prenda *{$estilo}* avanzó de *{$etapaAnterior}* a *{$etapaActual}*. "
            . "Progreso aproximado: *{$porcentaje}%*. ¡Ya casi está listo!";

        $this->dispatch($numero, $mensaje);
    }

    /**
     * Mensaje de confirmación cuando el pedido llega al estado 'Entregado'.
     */
    private function enviarConfirmacionEntrega(OrdenTrabajo $orden): void
    {
        $numero = $orden->cliente->celular_whatsapp;
        $cliente = $orden->cliente->nombre;
        $estilo = $orden->estilo->nombre_estilo;

        $mensaje = "✅ ¡{$cliente}, tu pedido de *{$estilo}* está LISTO y ha sido entregado! "
            . "Gracias por tu preferencia. 🙌";

        $this->dispatch($numero, $mensaje);
    }

    /**
     * Alerta especial de déficit de materiales.
     * Se llama cuando la explosión de materiales (MRP) detecta que no alcanza el stock.
     * 
     * @param OrdenTrabajo $orden
     * @param array $deficitMateriales  Lista de materiales con déficit ['nombre', 'faltante']
     */
    public function notificarDeficitMateriales(OrdenTrabajo $orden, array $deficitMateriales): void
    {
        $orden->loadMissing('cliente');
        $numero = $orden->cliente->celular_whatsapp;
        $cliente = $orden->cliente->nombre;

        // Construimos la lista de materiales en déficit, separados por coma
        $listaDeficit = collect($deficitMateriales)->map(function ($item) {
            // La función map de las "collections" de Laravel itera sobre cada elemento
            return "• {$item['nombre']} (faltan {$item['faltante']} {$item['unidad']})";
        })->implode("\n"); // implode une los elementos con salto de línea

        $mensaje = "⚠️ {$cliente}, existe un DÉFICIT de materiales para tu pedido:\n{$listaDeficit}\n"
            . "Por favor contáctanos para coordinar la provisión. Gracias.";

        $this->dispatch($numero, $mensaje);
    }

    /**
     * MÉTODO PRIVADO de despacho.
     * Aquí es donde iría la llamada real a la API de WhatsApp (Twilio, Meta, etc.).
     * Por ahora, registramos el mensaje en el Log de Laravel.
     * 
     * Para usar Twilio real, reemplazarías este log por algo como:
     * $client = new Twilio\Rest\Client($sid, $token);
     * $client->messages->create("whatsapp:{$numero}", ['from' => '...', 'body' => $mensaje]);
     */
    private function dispatch(string $numero, string $mensaje): void
    {
        // Log::info() guarda el mensaje en storage/logs/laravel.log — útil para debuggear
        Log::info("[WhatsApp OUT] → Para: {$numero} | Mensaje: {$mensaje}");
    }
}