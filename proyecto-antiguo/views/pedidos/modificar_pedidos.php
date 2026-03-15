<?php
require_once '../models/pedidosModel.php';

$id = $_GET['id'] ?? null;
$pedidosController = new PedidosModel();
$pedido = $pedidosController->obtenerPedidoPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_pedido'])) {
    $idCliente = $_POST['idCliente'];
    $idEmpleado = $_POST['idEmpleado'];
    $fechaPedido = $_POST['fechaPedido'];
    $idExpedidor = $_POST['idExpedidor'];

    $pedidosController->actualizarPedido($id, $idCliente, $idEmpleado, $fechaPedido, $idExpedidor);

    header('Location: ../controllers/mainController.php?option=dashboard&section=pedidos');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pedidos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Pedido</h5>
        <div class="mb-3">
            <label for="idCliente" class="form-label">ID Cliente:</label>
            <input type="number" class="form-control" id="idCliente" name="idCliente" value="<?= $pedido['IDCliente'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idEmpleado" class="form-label">ID Empleado:</label>
            <input type="number" class="form-control" id="idEmpleado" name="idEmpleado" value="<?= $pedido['IDEmpleado'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="fechaPedido" class="form-label">Fecha del Pedido:</label>
            <input type="date" class="form-control" id="fechaPedido" name="fechaPedido" value="<?= $pedido['FechaPedido'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idExpedidor" class="form-label">ID Expedidor:</label>
            <input type="number" class="form-control" id="idExpedidor" name="idExpedidor" value="<?= $pedido['IDExpedidor'] ?>" required>
        </div>
        <button type="submit" name="editar_pedido" class="btn btn-primary">Editar Pedido</button>
    </form>
</body> 
</html>
