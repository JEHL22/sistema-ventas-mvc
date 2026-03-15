# Sistema Ventas MVC

Este proyecto es la modernización de un sistema de ventas y producción hacia un stack moderno. El objetivo principal es gestionar eficientemente las ventas, inventario de materiales, el proceso de manufactura de prendas y la comunicación con los clientes, aplicando buenas prácticas de desarrollo y un enfoque didáctico para el aprendizaje de nuevas tecnologías.

---

## 💻 Stack Tecnológico

El proyecto está construido sobre un entorno moderno, pensado para facilitar el desarrollo, la escalabilidad y el despliegue:

*   **Entorno de Desarrollo:** WSL 2 (Ubuntu en Windows) usando Visual Studio Code (Remote WSL).
*   **Contenedores y Orquestación:** Docker Desktop y Docker Compose (Nginx, MariaDB, Redis).
*   **Backend:** Laravel (PHP) con un fuerte enfoque en el patrón MVC, migraciones y comandos Artisan.
*   **Frontend:**
    *   **Motor de Plantillas:** Blade.
    *   **Estilos y Assets:** Tailwind CSS + Vite (para empaquetado ultra rápido).
    *   **Interactividad:** JavaScript vanilla y librerías para renderizar gráficos dinámicos en los dashboards.
*   **Control de Versiones y Paquetes:** Git, Composer y npm.

---

## 🗄️ Estructura de la Base de Datos

El núcleo del sistema se basa en las siguientes entidades (gestionadas a través de migraciones de Laravel):

*   `clientes`: Almacena información de contacto y comercial (`id`, `nombre`, `ruc`, `galeria_tienda`, `celular_whatsapp`, `historial_pagos`). Vital para las integraciones y comunicación.
*   `materials`: Control de inventario de insumos (`id`, `descripcion`, `tipo`, `stock_total`, `costo_unitario`, `unidad_medida`).
*   `estilos`: Catálogo de productos o prendas master (`id`, `nombre_estilo`, `categoria`, `foto_referencia`, `cod_molde`).
*   `escandallos`: El "Bill of Materials" (BOM) o receta técnica de la prenda (`id`, `estilo_id`, `material_id`, `cantidad_consumo`, `porcentaje_merma`, `largo_costura`).
*   `operacions`: Define los Minutos Estándar Permitidos (SAM) para los procesos de manufactura (`id`, `nombre`, `maquina_clase`, `tiempo_sam_minutos`).
*   `orden_trabajos`: Controla los pedidos de fabricación a manufacturar (`id`, `cliente_id`, `estilo_id`, `cantidad_lote`, `fecha_ingreso`, `fecha_compromiso`, `estado_actual`). Los estados van fluyendo desde "Corte" hasta "Entregado".
*   `produccion_diarias`: Registro del rendimiento y eficiencia diaria de la planta (`id`, `orden_trabajo_id`, `fecha`, `operario_nombre`, `piezas_terminadas`, `tiempo_empleado`).

---

## ⚙️ Lógica de Negocio Principal (Business Logic)

El proyecto aborda las siguientes funcionalidades clave para optimizar la cadena de producción:

### 1. Explosión de Materiales (MRP)
Al registrar una nueva **Orden de Trabajo**, el sistema consulta el **escandallo** del estilo a fabricar. Se calcula el requerimiento total de insumos (`Cantidad Lote x Consumo por Prenda` + `Merma`) y se cruza con el `stock_total` de **materiales** para reservar inventario o disparar alertas de déficit antes de iniciar la producción.

### 2. Cálculo Científico de Fechas de Entrega
La estimación de entrega de un pedido no es manual. Se suman los **tiempos SAM (Standard Allowed Minutes)** de las **operaciones** requeridas, ajustándolos por la **eficiencia histórica del taller** (derivada de la producción diaria). Este tiempo real proyecta con precisión cuándo terminará de fabricarse el lote de la **orden de trabajo**.

### 3. Automatización de Comunicaciones (API de WhatsApp)
El sistema informa proactivamente a los **clientes** a través de su número de WhatsApp en momentos clave, dependiendo del `estado_actual` de la **orden de trabajo**:
*   Recepción exitosa del pedido.
*   Avance de producción (ej. paso de "Costura" a "Acabado").
*   Alertas directas en caso de existir déficits de insumos críticos provistos por el cliente.

---

## 📖 Reglas de Contribución y Aprendizaje

> **Nota para el desarrollo:** Dado el enfoque didáctico de este proyecto, es **OBLIGATORIO** comentar cada línea o bloque de código clave que se agregue o modifique (Controladores, Modelos, Vistas de Blade, Scripts y Migraciones).
> Se debe explicar siempre el propósito de las funciones específicas de Laravel utilizadas (e.g., Eloquent, colecciones, validaciones) para documentar el "por qué" de las implementaciones. El código priorizará la legibilidad y los nombres descriptivos en todo momento.

*Documentación en constante actualización a medida que se agregan nuevas características y migraciones.*
