<?php
require_once 'conexion.php';

class DetallesPedidosModel {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerDetallesPedidos() {
        $sql = "
        SELECT dp.IDDetalle, dp.IDPedido, dp.IDProducto, dp.Cantidad, p.NombreProducto 
        FROM DetallesPedidos dp
        JOIN Productos p ON dp.IDProducto = p.IDProducto";
    $result = $this->conn->query($sql);
    $detallesPedidos = [];
    while ($row = $result->fetch_assoc()) {
        $detallesPedidos[] = $row;
    }
    return $detallesPedidos;
    }

    public function agregarDetallePedido($idPedido, $idProducto, $cantidad) {
        $sql = "INSERT INTO DetallesPedidos (IDPedido, IDProducto, Cantidad) VALUES ('$idPedido', '$idProducto', '$cantidad')";
        try {
            return $this->conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            // Captura la excepción y la devuelve para que el controlador la maneje
            return $e->getMessage();
        }
    }

    public function eliminarDetallePedido($id) {
        $sql = "DELETE FROM DetallesPedidos WHERE IDDetalle = $id";
        return $this->conn->query($sql);
    }

    public function actualizarDetallePedido($id, $idPedido, $idProducto, $cantidad) {
        $sql = "UPDATE DetallesPedidos SET IDPedido = '$idPedido', IDProducto = '$idProducto', Cantidad = '$cantidad' WHERE IDDetalle = $id";
        return $this->conn->query($sql);
    }

    public function obtenerDetallePedidoPorId($id) {
        $sql = "SELECT * FROM DetallesPedidos WHERE IDDetalle = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
