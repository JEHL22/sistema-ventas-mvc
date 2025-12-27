<?php
require_once '../models/clientesModel.php';
require_once '../models/empleadosModel.php';
require_once '../models/expedidoresModel.php';

$clientesController = new ClientesModel();
$empleadosController = new EmpleadosModel();
$expedidoresController = new ExpedidoresModel();

$clientes = $clientesController->obtenerClientes();
$empleados = $empleadosController->obtenerEmpleados();
$expedidores = $expedidoresController->obtenerExpedidores();
?>
<form method="post" action="../controllers/pedidosController.php?option=guardarPedido" class="col-9 p-3">
    <div class="mb-3">
        <label for="idCliente" class="form-label">ID Cliente:</label>
        <select class="form-control" id="idCliente" name="idCliente" required>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['IDCliente'] ?>"><?= $cliente['IDCliente'] . '-' . $cliente['NombreCliente']?></option>
            <?php endforeach; ?>
        </select>

        <label for="idEmpleado" class="form-label">ID Empleado:</label>
        <select class="form-control" id="idEmpleado" name="idEmpleado" required>
            <?php foreach ($empleados as $empleado): ?>
                <option value="<?= $empleado['IDEmpleado'] ?>"><?= $empleado['IDEmpleado'] . '-' . $empleado['NombreEmpleado']?></option>
            <?php endforeach; ?>
        </select>

        <label for="fechaPedido" class="form-label">Fecha del Pedido:</label>
        <input type="date" class="form-control" id="fechaPedido" name="fechaPedido" required>

        <label for="idExpedidor" class="form-label">ID Expedidor:</label>
        <select class="form-control" id="idExpedidor" name="idExpedidor" required>
            <?php foreach ($expedidores as $expedidor): ?>
                <option value="<?= $expedidor['IDExpedidor'] ?>"><?= $expedidor['IDExpedidor'] . '-' . $expedidor['NombreExpedidor']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" name="registrar_pedido" class="btn btn-primary" value="guardar">Guardar</button>
</form>
