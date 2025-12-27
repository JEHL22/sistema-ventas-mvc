<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria['IDCategoria'] ?></td>
                <td><?= $categoria['NombreCategoria'] ?></td>
                <td><?= $categoria['Descripcion'] ?></td>
                <td>
                    <a href="../controllers/categoriaController.php?option=editarCategoria&id=<?= $categoria['IDCategoria'] ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/categoriaController.php?option=eliminarCategoria&id=<?= $categoria['IDCategoria'] ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
