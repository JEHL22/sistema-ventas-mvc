<?php
require_once '../models/clientesModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarCliente":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_cliente'])) {
            $nombre = $_POST['nombreCliente'];
            $nombreContacto = $_POST['nombreContacto'];
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];
            $codigoPostal = $_POST['codigoPostal'];
            $pais = $_POST['pais'];

            $controller = new ClientesModel();
            $controller->agregarCliente($nombre, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais);

            header('Location: mainController.php?option=dashboard&section=clientes');
            exit();
        }
        break;

    case "listarClientes":
        $clientesController = new ClientesModel();
        $clientes = $clientesController->obtenerClientes();
        include "../views/clientes/table_clientes.php";
        break;

    case "editarCliente":
        $id = $_GET['id'];
        $clientesController = new ClientesModel();
        $cliente = $clientesController->obtenerClientePorId($id);
        include "../views/clientes/modificar_clientes.php";
        break;

    case "eliminarCliente":
        $id = $_GET['id'];
        $clientesController = new ClientesModel();
        $clientesController->eliminarCliente($id);
        header('Location: mainController.php?option=dashboard&section=clientes');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
