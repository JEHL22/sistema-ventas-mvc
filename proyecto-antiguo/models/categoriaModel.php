<?php
    require_once ('conexion.php');

    class CategoriaModel{
        private $conn;

        public function __construct() {
            $conexion = new Conexion();
            $this->conn = $conexion->getConexion();
        }

        public function obtenerCategorias() {
            $sql = "SELECT * FROM categorias";
            $result = $this->conn->query($sql);
            $categorias = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $categorias[] = $row;
                }
            }
            return $categorias;
        }

        public function agregarCategoria($nombre, $descripcion) {
            $sql = "INSERT INTO categorias (NombreCategoria, Descripcion) VALUES ('$nombre', '$descripcion')";
            return $this->conn->query($sql);
        }

        public function eliminarCategoria($id) {
            $sql = "DELETE FROM categorias WHERE IDCategoria = $id";
            return $this->conn->query($sql);
        }

        public function editarCategoria($id, $nombre, $descripcion) {
            $sql = "UPDATE categorias SET NombreCategoria = '$nombre', Descripcion = '$descripcion' WHERE IDCategoria = $id";
            return $this->conn->query($sql);
        }

        public function obtenerCategoriaPorId($id) {
            $sql = "SELECT * FROM categorias WHERE IDCategoria = $id";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }
    }
?>