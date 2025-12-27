<table class="table">
    <thead>
        <tr>
            <th>ID Detalle</th>
            <th>ID Pedido</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detallesPedidos as $detallePedido): ?>
            <tr>
                <td><?= $detallePedido['IDDetalle'] ?></td>
                <td><?= $detallePedido['IDPedido'] ?></td>
                <td><?= $detallePedido['NombreProducto'] ?></td>
                <td><?= $detallePedido['Cantidad'] ?></td>
                <td>
                    <a href="../controllers/detallespedidosController.php?option=editarDetallePedido&id=<?= $detallePedido['IDDetalle'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/detallespedidosController.php?option=eliminarDetallePedido&id=<?= $detallePedido['IDDetalle'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
