<?php
require_once 'conexion.php';

class ProveedoresModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerProveedores() {
        $sql = "SELECT * FROM Proveedores";
        $result = $this->conn->query($sql);
        $proveedores = [];
        while ($row = $result->fetch_assoc()) {
            $proveedores[] = $row;
        }
        return $proveedores;
    }

    public function agregarProveedor($nombreProveedor, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais, $telefono) {
        $sql = "INSERT INTO Proveedores (NombreProveedor, NombreContacto, Direccion, Ciudad, CodigoPostal, Pais, Telefono) VALUES ('$nombreProveedor', '$nombreContacto', '$direccion', '$ciudad', '$codigoPostal', '$pais', '$telefono')";
        return $this->conn->query($sql);
    }

    public function eliminarProveedor($id) {
        $sql = "DELETE FROM Proveedores WHERE IDProveedor = $id";
        return $this->conn->query($sql);
    }

    public function actualizarProveedor($id, $nombreProveedor, $nombreContacto, $direccion, $ciudad, $codigoPostal, $pais, $telefono) {
        $sql = "UPDATE Proveedores SET NombreProveedor = '$nombreProveedor', NombreContacto = '$nombreContacto', Direccion = '$direccion', Ciudad = '$ciudad', CodigoPostal = '$codigoPostal', Pais = '$pais', Telefono = '$telefono' WHERE IDProveedor = $id";
        return $this->conn->query($sql);
    }

    public function obtenerProveedorPorId($id) {
        $sql = "SELECT * FROM Proveedores WHERE IDProveedor = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
