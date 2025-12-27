<?php
require_once '../models/expedidoresModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarExpedidor":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_expedidor'])) {
            $nombre = $_POST['nombreExpedidor'];
            $telefono = $_POST['telefono'];

            $controller = new ExpedidoresModel();
            $controller->agregarExpedidor($nombre, $telefono);

            header('Location: mainController.php?option=dashboard&section=expedidores');
            exit();
        }
        break;

    case "listarExpedidores":
        $expedidoresController = new ExpedidoresModel();
        $expedidores = $expedidoresController->obtenerExpedidores();
        include "../views/expedidores/table_expedidores.php";
        break;

    case "editarExpedidor":
        $id = $_GET['id'];
        $expedidoresController = new ExpedidoresModel();
        $expedidor = $expedidoresController->obtenerExpedidorPorId($id);
        include "../views/expedidores/modificar_expedidores.php";
        break;

    case "eliminarExpedidor":
        $id = $_GET['id'];
        $expedidoresController = new ExpedidoresModel();
        $expedidoresController->eliminarExpedidor($id);
        header('Location: mainController.php?option=dashboard&section=expedidores');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
