<?php
require_once '../models/empleadosModel.php';

$id = $_GET['id'] ?? null;
$empleadosController = new EmpleadosModel();
$empleado = $empleadosController->obtenerEmpleadoPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_empleado'])) {
    $apellido = $_POST['apellidoEmpleado'];
    $nombre = $_POST['nombreEmpleado'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $foto = $_POST['foto'];
    $notas = $_POST['notas'];

    $empleadosController->actualizarEmpleado($id, $apellido, $nombre, $fechaNacimiento, $foto, $notas);

    header('Location: ../controllers/mainController.php?option=dashboard&section=empleados');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Empleados</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Empleado</h5>
        <div class="mb-3">
            <label for="apellidoEmpleado" class="form-label">Apellido del Empleado:</label>
            <input type="text" class="form-control" id="apellidoEmpleado" name="apellidoEmpleado" value="<?= $empleado['ApellidoEmpleado'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nombreEmpleado" class="form-label">Nombre del Empleado:</label>
            <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" value="<?= $empleado['NombreEmpleado'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="<?= $empleado['FechaNacimiento'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto" value="<?= $empleado['Foto'] ?>">
        </div>
        <div class="mb-3">
            <label for="notas" class="form-label">Notas:</label>
            <textarea class="form-control" id="notas" name="notas"><?= $empleado['Notas'] ?></textarea>
        </div>
        <button type="submit" name="editar_empleado" class="btn btn-primary">Editar Empleado</button>
    </form>
</body> 
</html>
