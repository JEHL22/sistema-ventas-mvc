<?php
require_once '../models/productosModel.php';
require_once '../models/pedidosModel.php';

$pedidosController = new PedidosModel();
$productosController = new ProductosModel();

$pedidos = $pedidosController->obtenerPedidos();
$productos = $productosController->obtenerProductos();
?>

<form method="post" action="../controllers/detallespedidosController.php?option=guardarDetallePedido" class="col-9 p-3">
    <div class="mb-3">
        <label for="idPedido" class="form-label">ID del Pedido:</label>
        <select class="form-control" id="idPedido" name="idPedido" required>
            <?php foreach ($pedidos as $pedido): ?>
                <option value="<?= $pedido['IDPedido'] ?>"><?= $pedido['IDPedido']?></option>
            <?php endforeach; ?>
        </select>

        <label for="idProducto" class="form-label">ID del Producto:</label>
        <select class="form-control" id="idProducto" name="idProducto" required>
            <?php foreach ($productos as $producto): ?>
                <option value="<?= $producto['IDProducto'] ?>"><?= $producto['NombreProducto'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
    </div>
    <button type="submit" name="registrar_detallepedido" class="btn btn-primary" value="guardar">Guardar</button>
</form>
