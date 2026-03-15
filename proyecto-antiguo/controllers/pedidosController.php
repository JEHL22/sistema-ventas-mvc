<?php
require_once '../models/pedidosModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarPedido":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_pedido'])) {
            $idCliente = $_POST['idCliente'];
            $idEmpleado = $_POST['idEmpleado'];
            $fechaPedido = $_POST['fechaPedido'];
            $idExpedidor = $_POST['idExpedidor'];

            $controller = new PedidosModel();
            $controller->agregarPedido($idCliente, $idEmpleado, $fechaPedido, $idExpedidor);

            header('Location: mainController.php?option=dashboard&section=pedidos');
            exit();
        }
        break;

    case "listarPedidos":
        $pedidosController = new PedidosModel();
        $pedidos = $pedidosController->obtenerPedidos();
        include "../views/pedidos/table_pedidos.php";
        break;

    case "editarPedido":
        $id = $_GET['id'];
        $pedidosController = new PedidosModel();
        $pedido = $pedidosController->obtenerPedidoPorId($id);
        include "../views/pedidos/modificar_pedidos.php";
        break;

    case "eliminarPedido":
        $id = $_GET['id'];
        $pedidosController = new PedidosModel();
        $pedidosController->eliminarPedido($id);
        header('Location: mainController.php?option=dashboard&section=pedidos');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
