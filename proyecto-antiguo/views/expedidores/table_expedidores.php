<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($expedidores as $expedidor): ?>
            <tr>
                <td><?= $expedidor['IDExpedidor'] ?></td>
                <td><?= $expedidor['NombreExpedidor'] ?></td>
                <td><?= $expedidor['Telefono'] ?></td>
                <td>
                    <a href="../controllers/expedidoresController.php?option=editarExpedidor&id=<?= $expedidor['IDExpedidor'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/expedidoresController.php?option=eliminarExpedidor&id=<?= $expedidor['IDExpedidor'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
