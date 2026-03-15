<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Código Postal</th>
            <th>País</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente['IDCliente'] ?></td>
                <td><?= $cliente['NombreCliente'] ?></td>
                <td><?= $cliente['NombreContacto'] ?></td>
                <td><?= $cliente['Direccion'] ?></td>
                <td><?= $cliente['Ciudad'] ?></td>
                <td><?= $cliente['CodigoPostal'] ?></td>
                <td><?= $cliente['Pais'] ?></td>
                <td>
                    <a href="../controllers/clientesController.php?option=editarCliente&id=<?= $cliente['IDCliente'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/clientesController.php?option=eliminarCliente&id=<?= $cliente['IDCliente'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
