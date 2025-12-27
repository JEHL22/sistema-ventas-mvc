<?php
require_once '../models/empleadosModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarEmpleado":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_empleado'])) {
            $apellido = $_POST['apellidoEmpleado'];
            $nombre = $_POST['nombreEmpleado'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $foto = $_POST['foto'];
            $notas = $_POST['notas'];

            $controller = new EmpleadosModel();
            $controller->agregarEmpleado($apellido, $nombre, $fechaNacimiento, $foto, $notas);

            header('Location: mainController.php?option=dashboard&section=empleados');
            exit();
        }
        break;

    case "listarEmpleados":
        $empleadosController = new EmpleadosModel();
        $empleados = $empleadosController->obtenerEmpleados();
        include "../views/empleados/table_empleados.php";
        break;

    case "editarEmpleado":
        $id = $_GET['id'];
        $empleadosController = new EmpleadosModel();
        $empleado = $empleadosController->obtenerEmpleadoPorId($id);
        include "../views/empleados/modificar_empleados.php";
        break;

    case "eliminarEmpleado":
        $id = $_GET['id'];
        $empleadosController = new EmpleadosModel();
        $empleadosController->eliminarEmpleado($id);
        header('Location: mainController.php?option=dashboard&section=empleados');
        exit();

    default:
        echo "Opción no válida.";
        break;
    }
?>