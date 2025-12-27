<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Categoría</th>
            <th>Unidad</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $producto['IDProducto'] ?></td>
                <td><?= $producto['NombreProducto'] ?></td>
                <td><?= $producto['NombreProveedor'] ?></td>
                <td><?= $producto['NombreCategoria'] ?></td>
                <td><?= $producto['Unidad'] ?></td>
                <td><?= $producto['Precio'] ?></td>
                <td>
                    <a href="../controllers/productosController.php?option=editarProducto&id=<?= $producto['IDProducto'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/productosController.php?option=eliminarProducto&id=<?= $producto['IDProducto'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
