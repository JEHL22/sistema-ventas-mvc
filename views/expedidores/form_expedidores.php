<form method="post" action="../controllers/expedidoresController.php?option=guardarExpedidor" class="col-9 p-3">
    <div class="mb-3">
        <label for="nombreExpedidor" class="form-label">Nombre del Expedidor:</label>
        <input type="text" class="form-control" id="nombreExpedidor" name="nombreExpedidor" required>

        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>
    <button type="submit" name="registrar_expedidor" class="btn btn-primary" value="guardar">Guardar</button>
</form>
