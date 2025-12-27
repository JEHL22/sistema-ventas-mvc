<?php
require_once '../models/detallespedidosModel.php';

$id = $_GET['id'] ?? null;
$detallesPedidosController = new DetallesPedidosModel();
$detallePedido = $detallesPedidosController->obtenerDetallePedidoPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_detallepedido'])) {
    $idPedido = $_POST['idPedido'];
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];

    $detallesPedidosController->actualizarDetallePedido($id, $idPedido, $idProducto, $cantidad);

    header('Location: ../controllers/mainController.php?option=dashboard&section=detallespedidos');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Detalles de Pedidos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Detalle de Pedido</h5>
        <div class="mb-3">
            <label for="idPedido" class="form-label">ID del Pedido:</label>
            <input type="number" class="form-control" id="idPedido" name="idPedido" value="<?= $detallePedido['IDPedido'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idProducto" class="form-label">ID del Producto:</label>
            <input type="number" class="form-control" id="idProducto" name="idProducto" value="<?= $detallePedido['IDProducto'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?= $detallePedido['Cantidad'] ?>" required>
        </div>
        <button type="submit" name="editar_detallepedido" class="btn btn-primary">Editar Detalle de Pedido</button>
    </form>
</body> 
</html>
