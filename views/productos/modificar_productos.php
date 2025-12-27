<?php
require_once '../models/productosModel.php';

$id = $_GET['id'] ?? null;
$productosController = new ProductosModel();
$producto = $productosController->obtenerProductoPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_producto'])) {
    $nombreProducto = $_POST['nombreProducto'];
    $idProveedor = $_POST['idProveedor'];
    $idCategoria = $_POST['idCategoria'];
    $unidad = $_POST['unidad'];
    $precio = $_POST['precio'];

    $productosController->actualizarProducto($id, $nombreProducto, $idProveedor, $idCategoria, $unidad, $precio);

    header('Location: ../controllers/mainController.php?option=dashboard&section=productos');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Producto</h5>
        <div class="mb-3">
            <label for="nombreProducto" class="form-label">Nombre del Producto:</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="<?= $producto['NombreProducto'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idProveedor" class="form-label">ID Proveedor:</label>
            <input type="number" class="form-control" id="idProveedor" name="idProveedor" value="<?= $producto['IDProveedor'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idCategoria" class="form-label">ID Categoría:</label>
            <input type="number" class="form-control" id="idCategoria" name="idCategoria" value="<?= $producto['IDCategoria'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="unidad" class="form-label">Unidad:</label>
            <input type="text" class="form-control" id="unidad" name="unidad" value="<?= $producto['Unidad'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= $producto['Precio'] ?>" required>
        </div>
        <button type="submit" name="editar_producto" class="btn btn-primary">Editar Producto</button>
    </form>
</body> 
</html>
