<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Fecha del Pedido</th>
            <th>Expedidor</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= $pedido['IDPedido'] ?></td>
                <td><?= $pedido['NombreCliente'] ?></td>
                <td><?= $pedido['NombreEmpleado'] ?></td>
                <td><?= $pedido['FechaPedido'] ?></td>
                <td><?= $pedido['NombreExpedidor'] ?></td>
                <td>
                    <a href="../controllers/pedidosController.php?option=editarPedido&id=<?= $pedido['IDPedido'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/pedidosController.php?option=eliminarPedido&id=<?= $pedido['IDPedido'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
