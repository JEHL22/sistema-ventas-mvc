---
name: "Sistema Ventas MVC - Desarrollo y Contexto"
description: "Usa esta skill cuando el usuario te pida trabajar, agregar módulos, modificar o implementar nuevas características en el proyecto 'sistema-ventas-mvc'. Esta skill contiene la configuración del entorno, las indicaciones obligatorias sobre cómo comentar el código para el aprendizaje del usuario, el esquema de la base de datos y la lógica de negocio principal del sistema de ventas y producción."
---

# Contexto y Directivas del Proyecto 'sistema-ventas-mvc'

El proyecto **sistema-ventas-mvc** es la modernización de un sistema antiguo hacia un stack moderno. El usuario está aprendiendo estas nuevas tecnologías, por lo que **tu rol principal al interactuar con el código es ser sumamente didáctico y explicar el "por qué" de las cosas mediante comentarios detallados en el código**.

## 1. Stack Tecnológico del Entorno
Debes tener en cuenta el siguiente entorno en el que trabaja el usuario para cualquier comando o sugerencia:
- **Entorno de Desarrollo:** WSL 2 (Ubuntu en Windows) usando Visual Studio Code (Remote WSL).
- **Contenedores y Orquestación:** Docker Desktop y Docker Compose (Nginx, MariaDB, Redis).
- **Backend:** Laravel (PHP) - Fuerte enfoque en patrón MVC, migraciones y comandos Artisan.
- **Frontend:** Blade (motor de plantillas de Laravel), Tailwind CSS + Vite (para estilos y empaquetado ultra rápido), y JavaScript vanilla/librerías para renderizar gráficos dinámicos en los dashboards.
- **Herramientas de Control/Paquetes:** Git y npm.

## 2. REGLA DE ORO DE DESARROLLO: Comentar la Lógica
Dado que el usuario viene de un proyecto básico que hizo él mismo y ahora usa tecnologías modernas, **ES OBLIGATORIO**:
- **Comentar cada línea o bloque de código clave** que escribas (Controladores, Modelos, Vistas de Blade, Scripts de JS, rutas o migraciones).
- **Explicar el propósito** de cualquier función de Laravel específica (e.g., Eloquent, colecciones, relaciones, validaciones) para que el usuario pueda comprender y aprender cómo funciona este nuevo stack.
- Preferir código legible, limpio y con nombres descriptivos.

## 3. Estructura de Base de Datos y Modelos
El proyecto utiliza las siguientes tablas (ya han sido creadas mediante migraciones de Laravel):

- **clientes**: `id`, `nombre`, `ruc`, `galeria_tienda`, `celular_whatsapp`, `historial_pagos`. (Almacena datos del cliente, vital para la API de WhatsApp).
- **materials**: `id`, `descripcion`, `tipo`, `stock_total`, `costo_unitario`, `unidad_medida`. (Inventario de insumos).
- **estilos**: `id`, `nombre_estilo`, `categoria`, `foto_referencia`, `cod_molde`. (El catálogo de productos/prendas).
- **escandallos**: `id`, `estilo_id` (FK a estilos), `material_id` (FK a materials), `cantidad_consumo`, `porcentaje_merma`, `largo_costura`. (El 'Bill of Materials' o BOM, la receta técnica de la prenda).
- **operacions**: `id`, `nombre`, `maquina_clase`, `tiempo_sam_minutos`. (Los Minutos Estándar Permitidos o SAM para cada paso de costura).
- **orden_trabajos**: `id`, `cliente_id` (FK a clientes), `estilo_id` (FK a estilos), `cantidad_lote`, `fecha_ingreso`, `fecha_compromiso`, `estado_actual` (Enum: Corte, Costura, Acabado, Entregado). (Controla los pedidos a manufacturar).
- **produccion_diarias**: `id`, `orden_trabajo_id` (FK a orden_trabajos), `fecha`, `operario_nombre`, `piezas_terminadas`, `tiempo_empleado`. (Rendimiento y eficiencia diaria de la planta).

## 4. Lógica de Negocio a Implementar (Business Logic)
Al desarrollar o modificar funcionalidades, ten en cuenta cómo interactúan estas entidades:

1. **Explosión de Materiales (MRP):**
   - Al crear una nueva `Orden_Trabajo` (ej. fabricar N cantidad de X prenda), el sistema debe revisar el `escandallo` para ese `estilo`.
   - Calcular requerimiento total: `Cantidad_Lote x Consumo_por_Prenda` + Porcentaje de `merma`.
   - Comparar con el `stock_total` en `materials` para reservar esa cantidad o generar *alertas de déficit* de materiales.

2. **Cálculo Científico de Fechas de Entrega:**
   - La fecha de entrega se estima sumando los `tiempo_sam_minutos` de las `operaciones` requeridas por la prenda.
   - Esos tiempos teóricos se ajustan dividiéndolos por la **eficiencia histórica del taller** (datos obtenidos de `produccion_diarias`), lo que brinda un tiempo real (Ej. SAM / Eficiencia). Este total se multiplica por el volumen del lote de la `orden_trabajo` para proyectar el fin.

3. **Automatización de Comunicaciones (Notificaciones vía WhatsApp):**
   - El sistema tiene un componente programado para la interacción con la API de WhatsApp basándose en el `estado_actual` de la `orden_trabajo` y el `celular_whatsapp` del cliente.
   - Puntos de intercepción esperados: Mensaje inicial de recepción del pedido/tela, reporte automático del porcentaje de avance (por ejemplo, actualizando de "Costura" a "Acabado"), y alertas directas al cliente si hay déficit inminente de materiales provistos durante la producción.
