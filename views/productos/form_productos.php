<?php
require_once '../models/categoriaModel.php';
require_once '../models/proveedoresModel.php';

$categoriasController = new CategoriaModel();
$proveedoresController = new ProveedoresModel();

$categorias = $categoriasController->obtenerCategorias();
$proveedores = $proveedoresController->obtenerProveedores();
?>
<form method="post" action="../controllers/productosController.php?option=guardarProducto" class="col-9 p-3">
    <div class="mb-3">
        <label for="nombreProducto" class="form-label">Nombre del Producto:</label>
        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>

        <label for="idProveedor" class="form-label">ID Proveedor:</label>
        <select class="form-control" id="idProveedor" name="idProveedor" required>
            <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?= $proveedor['IDProveedor'] ?>"><?= $proveedor['IDProveedor'] . '-' . $proveedor['NombreProveedor']?></option>
            <?php endforeach; ?>
        </select>

        <label for="idCategoria" class="form-label">ID Categoría:</label>
        <select class="form-control" id="idCategoria" name="idCategoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['IDCategoria'] ?>"><?= $categoria['IDCategoria'] . '-' . $categoria['NombreCategoria']?></option>
            <?php endforeach; ?>
        </select>

        <label for="unidad" class="form-label">Unidad:</label>
        <input type="text" class="form-control" id="unidad" name="unidad" required>

        <label for="precio" class="form-label">Precio:</label>
        <input type="number" step="0.01" class="form-control" id="precio" name="precio" min="1" required>
    </div>
    <button type="submit" name="registrar_producto" class="btn btn-primary" value="guardar">Guardar</button>
</form>
