# Diccionario de Datos y Estructuras

Este documento mantiene un registro actualizado de las tablas del sistema, incluyendo los nuevos módulos que se van agregando durante el desarrollo. Cada vez que se crea una nueva migración, se debe actualizar esta documentación.

## Tabla: `estilos`

> **Propósito:** Catálogo principal de las prendas a fabricar. Cada estilo es la cabecera para los escandallos (BOM) requeridos en producción.

| Campo | Tipo | Restricciones | Descripción |
| :--- | :--- | :--- | :--- |
| `id` | BigInt | Primary Key, Auto Increment | Identificador único del estilo. |
| `nombre_estilo` | String | Not Null | Nombre descriptivo de la prenda (ej: "Polo Cuello Camisero M/C"). |
| `categoria` | String | Not Null | Agrupación para reportes (ej: "Polos", "Casacas", "Pantalones"). |
| `foto_referencia` | String | Nullable | Ruta del archivo o URL de la imagen que muestra cómo es la prenda terminada. |
| `cod_molde` | String | Unique, Not Null | Código físico/digital del patrón/molde (ej: "M-P-001"), garantiza que no haya moldes duplicados. |
| `created_at` | Timestamp | Nullable | Fecha de creación del registro. |
| `updated_at` | Timestamp | Nullable | Fecha de última modificación. |

---

*(Más tablas se documentarán aquí conforme se vayan estructurando en las migraciones).*
