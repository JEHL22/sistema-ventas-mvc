<?php
require_once 'conexion.php';

class ExpedidoresModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerExpedidores() {
        $sql = "SELECT * FROM Expedidores";
        $result = $this->conn->query($sql);
        $expedidores = [];
        while ($row = $result->fetch_assoc()) {
            $expedidores[] = $row;
        }
        return $expedidores;
    }

    public function agregarExpedidor($nombre, $telefono) {
        $sql = "INSERT INTO Expedidores (NombreExpedidor, Telefono) VALUES ('$nombre', '$telefono')";
        return $this->conn->query($sql);
    }

    public function eliminarExpedidor($id) {
        $sql = "DELETE FROM Expedidores WHERE IDExpedidor = $id";
        return $this->conn->query($sql);
    }

    public function actualizarExpedidor($id, $nombre, $telefono) {
        $sql = "UPDATE Expedidores SET NombreExpedidor = '$nombre', Telefono = '$telefono' WHERE IDExpedidor = $id";
        return $this->conn->query($sql);
    }

    public function obtenerExpedidorPorId($id) {
        $sql = "SELECT * FROM Expedidores WHERE IDExpedidor = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
