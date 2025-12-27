<?php
require_once '../models/clientesModel.php';

$id = $_GET['id'] ?? null;
$clientesController = new ClientesModel();
$cliente = $clientesController->obtenerClientePorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_cliente'])) {
    $nombre = $_POST['nombreCliente'];
    $nombreContacto = $_POST['nombreContacto'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $codigoPostal = $_POST['codigoPostal'];
    $pais = $_POST['pais'];

    $clientesController->actualizarCliente($id, $nombre, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais);

    header('Location: ../controllers/mainController.php?option=dashboard&section=clientes');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Clientes</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Cliente</h5>
        <div class="mb-3">
            <label for="nombreCliente" class="form-label">Nombre del Cliente:</label>
            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" value="<?= $cliente['NombreCliente'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nombreContacto" class="form-label">Nombre del Contacto:</label>
            <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" value="<?= $cliente['NombreContacto'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $cliente['Direccion'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad:</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= $cliente['Ciudad'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="codigoPostal" class="form-label">Código Postal:</label>
            <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?= $cliente['CodigoPostal'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="pais" class="form-label">País:</label>
            <input type="text" class="form-control" id="pais" name="pais" value="<?= $cliente['Pais'] ?>" required>
        </div>
        <button type="submit" name="editar_cliente" class="btn btn-primary">Editar Cliente</button>
    </form>
</body> 
</html>
