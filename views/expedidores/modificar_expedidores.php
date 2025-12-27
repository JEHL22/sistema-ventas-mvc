<?php
require_once '../models/expedidoresModel.php';

$id = $_GET['id'] ?? null;
$expedidoresController = new ExpedidoresModel();
$expedidor = $expedidoresController->obtenerExpedidorPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_expedidor'])) {
    $nombre = $_POST['nombreExpedidor'];
    $telefono = $_POST['telefono'];

    $expedidoresController->actualizarExpedidor($id, $nombre, $telefono);

    header('Location: ../controllers/mainController.php?option=dashboard&section=expedidores');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Expedidores</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Expedidor</h5>
        <div class="mb-3">
            <label for="nombreExpedidor" class="form-label">Nombre del Expedidor:</label>
            <input type="text" class="form-control" id="nombreExpedidor" name="nombreExpedidor" value="<?= $expedidor['NombreExpedidor'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $expedidor['Telefono'] ?>" required>
        </div>
        <button type="submit" name="editar_expedidor" class="btn btn-primary">Editar Expedidor</button>
    </form>
</body> 
</html>
