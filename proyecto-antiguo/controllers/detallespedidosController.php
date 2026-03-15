<?php
require_once '../models/detallespedidosModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarDetallePedido":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_detallepedido'])) {
            $idPedido = $_POST['idPedido'];
            $idProducto = $_POST['idProducto'];
            $cantidad = $_POST['cantidad'];

            $controller = new DetallesPedidosModel();
            $result=$controller->agregarDetallePedido($idPedido, $idProducto, $cantidad);

            if ($result === true) {
                header('Location: mainController.php?option=dashboard&section=detallespedidos');
                exit();
            } else {
                // Mostrar alerta con el mensaje de error
                echo "<script>alert('Error al agregar detalle del pedido (clave foranea inexistente): $result');</script>";
                // Redirigir de vuelta al formulario o a una página de error
                header('Refresh: 0; URL=mainController.php?option=dashboard&section=detallespedidos');
                exit();
            }
        }
        break;

    case "listarDetallesPedidos":
        $detallesPedidosController = new DetallesPedidosModel();
        $detallesPedidos = $detallesPedidosController->obtenerDetallesPedidos();
        include "../views/detallespedidos/table_detallespedidos.php";
        break;

    case "editarDetallePedido":
        $id = $_GET['id'];
        $detallesPedidosController = new DetallesPedidosModel();
        $detallePedido = $detallesPedidosController->obtenerDetallePedidoPorId($id);
        include "../views/detallespedidos/modificar_detallespedidos.php";
        break;    

    case "eliminarDetallePedido":
        $id = $_GET['id'];
        $detallesPedidosController = new DetallesPedidosModel();
        $detallesPedidosController->eliminarDetallePedido($id);
        header('Location: mainController.php?option=dashboard&section=detallespedidos');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
