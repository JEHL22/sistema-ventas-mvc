<form method="post" action="../controllers/categoriaController.php?option=guardarCategoria"  class="col-9 p-3">
    <div class="mb-3">
        <label for="nombreCategoria" class="form-label">Nombre de categoría:</label>
        <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required>

        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea type="text" class="form-control" id="descripcion" name="descripcion" required></textarea>
    </div>
    <!-- Otros campos según la tabla categorías -->
<button type="submit" name="registrar_categoria" class="btn btn-primary" value="guardar">Guardar</button></form>
