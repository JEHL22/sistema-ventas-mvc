<?php
require_once '../models/categoriaModel.php';

$id = $_GET['id'] ?? null;
$categoriasController = new CategoriaModel();
$categoria = $categoriasController->obtenerCategoriaPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_categoria'])) {
    $nombre = $_POST['nombreCategoria'];
    $descripcion = $_POST['descripcion'];

    $categoriasController->editarCategoria($id, $nombre, $descripcion);

    header('Location: ../controllers/mainController.php?option=dashboard&section=categorias');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Layout</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" class="col-4 p-3 m-auto">
        <h5 class="text-center alert alert-secondary">Modificar Categoría</h5>
        <div class="mb-3">
            <label for="nombreCategoria" class="form-label">Nombre de categoría:</label>
            <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" value="<?= $categoria['NombreCategoria'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?= $categoria['Descripcion'] ?></textarea>
        </div>
        <button type="submit" name="editar_categoria" class="btn btn-primary">Editar Categoría</button>
    </form>
</body> 
</html>
