<form method="post" action="../controllers/empleadosController.php?option=guardarEmpleado" class="col-9 p-3">
    <div class="mb-3">
        <label for="apellidoEmpleado" class="form-label">Apellido del Empleado:</label>
        <input type="text" class="form-control" id="apellidoEmpleado" name="apellidoEmpleado" required>

        <label for="nombreEmpleado" class="form-label">Nombre del Empleado:</label>
        <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" required>

        <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>

        <label for="foto" class="form-label">Foto:</label>
        <input type="file" class="form-control" id="foto" name="foto">

        <label for="notas" class="form-label">Notas:</label>
        <textarea class="form-control" id="notas" name="notas"></textarea>
    </div>
    <button type="submit" name="registrar_empleado" class="btn btn-primary" value="guardar">Guardar</button>
</form>
