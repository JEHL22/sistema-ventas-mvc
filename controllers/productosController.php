<?php
require_once '../models/productosModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarProducto":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_producto'])) {
            $nombreProducto = $_POST['nombreProducto'];
            $idProveedor = $_POST['idProveedor'];
            $idCategoria = $_POST['idCategoria'];
            $unidad = $_POST['unidad'];
            $precio = $_POST['precio'];

            $controller = new ProductosModel();
            $result=$controller->agregarProducto($nombreProducto, $idProveedor, $idCategoria, $unidad, $precio);

            if ($result === true) {
                header('Location: mainController.php?option=dashboard&section=productos');
                exit();
            } else {
                // Mostrar alerta con el mensaje de error
                echo "<script>alert('Error al agregar el producto (clave foranea inexistente): $result');</script>";
                // Redirigir de vuelta al formulario o a una página de error
                header('Refresh: 0; URL=mainController.php?option=dashboard&section=productos');
                exit();
            }
        }
        break;

    case "listarProductos":
        $productosController = new ProductosModel();
        $productos = $productosController->obtenerProductos();
        include "../views/productos/table_productos.php";
        break;

    case "editarProducto":
        $id = $_GET['id'];
        $productosController = new ProductosModel();
        $producto = $productosController->obtenerProductoPorId($id);
        include "../views/productos/modificar_productos.php";
        break;

    case "eliminarProducto":
        $id = $_GET['id'];
        $productosController = new ProductosModel();
        $productosController->eliminarProducto($id);
        header('Location: mainController.php?option=dashboard&section=productos');
        exit();

    default:
        echo "Opción no válida.";
        break;
}
?>
