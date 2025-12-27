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
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proveedores as $proveedor): ?>
            <tr>
                <td><?= $proveedor['IDProveedor'] ?></td>
                <td><?= $proveedor['NombreProveedor'] ?></td>
                <td><?= $proveedor['NombreContacto'] ?></td>
                <td><?= $proveedor['Direccion'] ?></td>
                <td><?= $proveedor['Ciudad'] ?></td>
                <td><?= $proveedor['CodigoPostal'] ?></td>
                <td><?= $proveedor['Pais'] ?></td>
                <td><?= $proveedor['Telefono'] ?></td>
                <td>
                    <a href="../controllers/proveedoresController.php?option=editarProveedor&id=<?= $proveedor['IDProveedor'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/proveedoresController.php?option=eliminarProveedor&id=<?= $proveedor['IDProveedor'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
