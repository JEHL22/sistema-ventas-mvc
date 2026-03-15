<form method="post" action="../controllers/clientesController.php?option=guardarCliente" class="col-9 p-3">
    <div class="mb-3">
        <label for="nombreCliente" class="form-label">Nombre del Cliente:</label>
        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>

        <label for="nombreContacto" class="form-label">Nombre del Contacto:</label>
        <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" required>

        <label for="direccion" class="form-label">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required>

        <label for="ciudad" class="form-label">Ciudad:</label>
        <input type="text" class="form-control" id="ciudad" name="ciudad" required>

        <label for="codigoPostal" class="form-label">Código Postal:</label>
        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" required>

        <label for="pais" class="form-label">País:</label>
        <input type="text" class="form-control" id="pais" name="pais" required>
    </div>
    <button type="submit" name="registrar_cliente" class="btn btn-primary" value="guardar">Guardar</button>
</form>
