<?php
session_start();
include("../models/userModel.php");
$option = $_GET["option"] ?? null;
$section = $_GET['section'] ?? '';

switch ($option){
    case "login":
        include("../views/login.php");
        break;

    case "proceso-login":
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $conexion = new UserModel();
        $result = $conexion->permitirUsuario($user, $pass);
        
        if ($result) {
            $_SESSION['user'] = $user;
            header("Location: mainController.php?option=dashboard");
            exit;
        } else {
            header("Location: mainController.php?option=login");
            exit;
        }
        break;
        
    case "registro":
        include("../views/register.php");
        break;        

    case "proceso-registro":
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $codigoAdmin = $_POST["codigoAdmin"];
    
        $conexion = new UserModel();
        $result = $conexion->registrarUsuario($nombre, $correo, $user, $pass, $codigoAdmin);
    
        if ($result === true) {
            header("Location: mainController.php?option=login");
            exit();
        } else {
            echo "<script>alert('Error al registrar usuario: $result');</script>";
            header('Refresh: 0; URL=mainController.php?option=registro');
            exit();
        }    
        break;

    case "dashboard":
        if (!isset($_SESSION['user'])) {
            header("Location: mainController.php?option=login");
            exit;
        }
        $section = $_GET["section"] ?? null;
        switch ($section) {
            case "categorias":
                include "../index.php";
                break;
            case "clientes":
                include "../index.php";
                break;
            case "detallespedidos":
                include "../index.php";
                break;
            case "empleados":
                include "../index.php";
                break;
            case "expedidores":
                include "../index.php";
                break;
            case "pedidos":
                include "../index.php";
                break;
            case "productos":
                include "../index.php";
                break;
            case "proveedores":
                include "../index.php";
                break;
            default:
                include "../views/dashboard_inicio.php";
                break;
        }
        break;
        
    case "logout":
        session_unset();
        session_destroy();
        header("Location: mainController.php?option=login");
        exit();   

    default:
        echo "Opción no válida.";
        break;    
} 
?>
