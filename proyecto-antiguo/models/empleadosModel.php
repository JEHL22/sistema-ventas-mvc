<?php
require_once 'conexion.php';

class EmpleadosModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerEmpleados() {
        $sql = "SELECT * FROM Empleados";
        $result = $this->conn->query($sql);
        $empleados = [];
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
        return $empleados;
    }

    public function agregarEmpleado($apellido, $nombre, $fechaNacimiento, $foto, $notas) {
        $sql = "INSERT INTO Empleados (ApellidoEmpleado, NombreEmpleado, FechaNacimiento, Foto, Notas) VALUES ('$apellido', '$nombre', '$fechaNacimiento', '$foto', '$notas')";
        return $this->conn->query($sql);
    }

    public function eliminarEmpleado($id) {
        $sql = "DELETE FROM Empleados WHERE IDEmpleado = $id";
        return $this->conn->query($sql);
    }

    public function actualizarEmpleado($id, $apellido, $nombre, $fechaNacimiento, $foto, $notas) {
        $sql = "UPDATE Empleados SET ApellidoEmpleado = '$apellido', NombreEmpleado = '$nombre', FechaNacimiento = '$fechaNacimiento', Foto = '$foto', Notas = '$notas' WHERE IDEmpleado = $id";
        return $this->conn->query($sql);
    }

    public function obtenerEmpleadoPorId($id) {
        $sql = "SELECT * FROM Empleados WHERE IDEmpleado = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
