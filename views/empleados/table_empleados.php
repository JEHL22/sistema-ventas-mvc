<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Fecha de Nacimiento</th>
            <th>Foto</th>
            <th>Notas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?= $empleado['IDEmpleado'] ?></td>
                <td><?= $empleado['ApellidoEmpleado'] ?></td>
                <td><?= $empleado['NombreEmpleado'] ?></td>
                <td><?= $empleado['FechaNacimiento'] ?></td>
                <td><?= $empleado['Foto'] ?></td>
                <td><?= $empleado['Notas'] ?></td>
                <td>
                    <a href="../controllers/empleadosController.php?option=editarEmpleado&id=<?= $empleado['IDEmpleado'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../controllers/empleadosController.php?option=eliminarEmpleado&id=<?= $empleado['IDEmpleado'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
