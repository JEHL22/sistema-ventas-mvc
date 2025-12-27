<?php
require_once("conexion.php");

class UserModel {
    private $conn;
    private $adminCode = 'ADMIN123';

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function permitirUsuario($user, $pass) {
        $sql = "SELECT contrasena FROM usuarios WHERE usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPass);
            $stmt->fetch();
            // Verificar la contraseña
            if (password_verify($pass, $hashedPass)) {
                return true;
            }
        }
        return false;
    }

    public function registrarUsuario($nombre, $correo, $user, $pass, $codigoAdmin) {
        if ($codigoAdmin !== $this->adminCode) {
            return "Código de administrador incorrecto.";
        }

        // Encriptar la contraseña
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (nombre, correo, usuario, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $correo, $user, $hashedPass);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return $stmt->error;
            }
        } catch (mysqli_sql_exception $e) {
            return $e->getMessage();
        }
    }
}
?>
