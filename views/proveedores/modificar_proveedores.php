<?php
require_once '../models/proveedoresModel.php';

$id = $_GET['id'] ?? null;
$proveedoresController = new ProveedoresModel();
$proveedor = $proveedoresController->obtenerProveedorPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_proveedor'])) {
    $nombreProveedor = $_POST['nombreProveedor'];
    $nombreContacto = $_POST['nombreContacto'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $codigoPostal = $_POST['codigoPostal'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];

    $proveedoresController->actualizarProveedor($id, $nombreProveedor, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais, $telefono);

    header('Location: ../controllers/mainController.php?option=dashboard&section=proveedores');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Proveedores</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Proveedor</h5>
        <div class="mb-3">
            <label for="nombreProveedor" class="form-label">Nombre del Proveedor:</label>
            <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor" value="<?= $proveedor['NombreProveedor'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nombreContacto" class="form-label">Nombre del Contacto:</label>
            <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" value="<?= $proveedor['NombreContacto'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $proveedor['Direccion'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad:</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= $proveedor['Ciudad'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="codigoPostal" class="form-label">Código Postal:</label>
            <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?= $proveedor['CodigoPostal'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="pais" class="form-label">País:</label>
            <input type="text" class="form-control" id="pais" name="pais" value="<?= $proveedor['Pais'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $proveedor['Telefono'] ?>" required>
        </div>
        <button type="submit" name="editar_proveedor" class="btn btn-primary">Editar Proveedor</button>
    </form>
</body> 
</html>
