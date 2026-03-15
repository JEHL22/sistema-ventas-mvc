<?php
require_once 'conexion.php';

class ProductosModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerProductos() {
        $sql = "
            SELECT p.IDProducto, p.NombreProducto, p.IDProveedor, pr.NombreProveedor, p.IDCategoria, c.NombreCategoria, p.Unidad, p.Precio
            FROM Productos p
            JOIN Proveedores pr ON p.IDProveedor = pr.IDProveedor
            JOIN Categorias c ON p.IDCategoria = c.IDCategoria";
        $result = $this->conn->query($sql);
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        return $productos;
    }

    public function agregarProducto($nombreProducto, $idProveedor, $idCategoria, $unidad, $precio) {
        $sql = "INSERT INTO Productos (NombreProducto, IDProveedor, IDCategoria, Unidad, Precio) VALUES ('$nombreProducto', '$idProveedor', '$idCategoria', '$unidad', '$precio')";
        try {
            return $this->conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            return $e->getMessage();
        }
    }

    public function eliminarProducto($id) {
        $sql = "DELETE FROM Productos WHERE IDProducto = $id";
        return $this->conn->query($sql);
    }

    public function actualizarProducto($id, $nombreProducto, $idProveedor, $idCategoria, $unidad, $precio) {
        $sql = "UPDATE Productos SET NombreProducto = '$nombreProducto', IDProveedor = '$idProveedor', IDCategoria = '$idCategoria', Unidad = '$unidad', Precio = '$precio' WHERE IDProducto = $id";
        return $this->conn->query($sql);
    }

    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM Productos WHERE IDProducto = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
