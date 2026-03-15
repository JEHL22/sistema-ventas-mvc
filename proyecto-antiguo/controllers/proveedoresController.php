<?php
require_once '../models/proveedoresModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarProveedor":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_proveedor'])) {
            $nombreProveedor = $_POST['nombreProveedor'];
            $nombreContacto = $_POST['nombreContacto'];
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];
            $codigoPostal = $_POST['codigoPostal'];
            $pais = $_POST['pais'];
            $telefono = $_POST['telefono'];

            $controller = new ProveedoresModel();
            $controller->agregarProveedor($nombreProveedor, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais, $telefono);

            header('Location: mainController.php?option=dashboard&section=proveedores');
            exit();
        }
        break;

    case "listarProveedores":
        $proveedoresController = new ProveedoresModel();
        $proveedores = $proveedoresController->obtenerProveedores();
        include "../views/proveedores/table_proveedores.php";
        break;

    case "editarProveedor":
        $id = $_GET['id'];
        $proveedoresController = new ProveedoresModel();
        $proveedor = $proveedoresController->obtenerProveedorPorId($id);
        include "../views/proveedores/modificar_proveedores.php";
        break;

    case "eliminarProveedor":
        $id = $_GET['id'];
        $proveedoresController = new ProveedoresModel();
        $proveedoresController->eliminarProveedor($id);
        header('Location: mainController.php?option=dashboard&section=proveedores');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
