<?php
require_once 'conexion.php';

class PedidosModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerPedidos() {
        $sql = "
        SELECT p.IDPedido, p.IDCliente, c.NombreCliente, p.IDEmpleado, e.NombreEmpleado, p.FechaPedido, p.IDExpedidor, ex.NombreExpedidor
        FROM Pedidos p
        JOIN Clientes c ON p.IDCliente = c.IDCliente
        JOIN Empleados e ON p.IDEmpleado = e.IDEmpleado
        JOIN Expedidores ex ON p.IDExpedidor = ex.IDExpedidor";
        $result = $this->conn->query($sql);
        $pedidos = [];
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }
    return $pedidos;
    }

    public function agregarPedido($idCliente, $idEmpleado, $fechaPedido, $idExpedidor) {
        $sql = "INSERT INTO Pedidos (IDCliente, IDEmpleado, FechaPedido, IDExpedidor) VALUES ('$idCliente', '$idEmpleado', '$fechaPedido', '$idExpedidor')";
        return $this->conn->query($sql);
    }

    public function eliminarPedido($id) {
        $sql = "DELETE FROM Pedidos WHERE IDPedido = $id";
        return $this->conn->query($sql);
    }

    public function actualizarPedido($id, $idCliente, $idEmpleado, $fechaPedido, $idExpedidor) {
        $sql = "UPDATE Pedidos SET IDCliente = '$idCliente', IDEmpleado = '$idEmpleado', FechaPedido = '$fechaPedido', IDExpedidor = '$idExpedidor' WHERE IDPedido = $id";
        return $this->conn->query($sql);
    }

    public function obtenerPedidoPorId($id) {
        $sql = "SELECT * FROM Pedidos WHERE IDPedido = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
