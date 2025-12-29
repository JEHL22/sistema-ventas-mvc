# Sistema de Gestión Web (MVC)

Este es un proyecto web desarrollado en **PHP** siguiendo el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**. Permite la gestión administrativa de clientes, productos, pedidos y proveedores.
LINK : https://julio-sistemas.free.nf/controllers/mainController.php?option=dashboard&section=proveedores
USER:     ADMIN
PASSWORD: ADMIN

## 🚀 Tecnologías Utilizadas

* **Lenguaje:** PHP (Nativo)
* **Base de Datos:** MySQL
* **Arquitectura:** MVC
* **Frontend:** HTML5, CSS3
* **Servidor Local:** XAMPP (Apache)

## 📂 Estructura del Proyecto

El proyecto sigue una estructura MVC clara para separar la lógica de negocio de la interfaz de usuario:

* `/controllers`: Lógica que maneja las peticiones (Clientes, Pedidos, Productos, etc.).
* `/models`: Interacción con la base de datos (Consultas SQL).
* `/views`: Interfaces de usuario (Formularios y Tablas).
* `/css`: Estilos del proyecto.

## ⚙️ Instalación y Configuración

Sigue estos pasos para probar el proyecto en tu máquina local:

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/JEHL22/sistema-ventas-mvc.git](https://github.com/JEHL22/sistema-ventas-mvc.git)
    ```

2.  **Base de Datos:**
    * Abre phpMyAdmin (en XAMPP).
    * Crea una base de datos nueva.
    * Importa el archivo `.sql` que se encuentra en la carpeta del proyecto (asegúrate de haberlo subido o exportarlo de tu local).

3.  **Configuración:**
    * Ve al archivo `models/conexion.php`.
    * Asegúrate de que las credenciales (servidor, usuario, contraseña y nombre de la base de datos) coincidan con las de tu entorno local.

4.  **Ejecutar:**
    * Abre tu navegador y ve a `http://localhost/nombre_de_tu_carpeta`.

## ✨ Funcionalidades Principales

* **Autenticación:** Login y Registro de usuarios (`login.php`, `register.php`).
* **Dashboard:** Panel principal de administración.
* **Módulos CRUD:** Creación, lectura, actualización y eliminación de registros para:
    * 📦 Productos
    * 👥 Clientes y Empleados
    * 📝 Pedidos y Detalles
    * 🚚 Proveedores y Expedidores
---
*Desarrollado por JEHL*
