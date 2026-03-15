<?php
require_once 'conexion.php';

class ClientesModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerClientes() {
        $sql = "SELECT * FROM Clientes";
        $result = $this->conn->query($sql);
        $clientes = [];
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
        return $clientes;
    }

    public function agregarCliente($nombre, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais) {
        $sql = "INSERT INTO Clientes (NombreCliente, NombreContacto, Direccion, Ciudad, CodigoPostal, Pais) VALUES ('$nombre', '$nombreContacto', '$direccion', '$ciudad', '$codigoPostal', '$pais')";
        return $this->conn->query($sql);
    }

    public function eliminarCliente($id) {
        $sql = "DELETE FROM Clientes WHERE IDCliente = $id";
        return $this->conn->query($sql);
    }

    public function actualizarCliente($id, $nombre, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais) {
        $sql = "UPDATE Clientes SET NombreCliente = '$nombre', NombreContacto = '$nombreContacto', Direccion = '$direccion', Ciudad = '$ciudad', CodigoPostal = '$codigoPostal', Pais = '$pais' WHERE IDCliente = $id";
        return $this->conn->query($sql);
    }

    public function obtenerClientePorId($id) {
        $sql = "SELECT * FROM Clientes WHERE IDCliente = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
