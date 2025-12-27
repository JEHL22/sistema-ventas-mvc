<?php
require_once '../models/categoriaModel.php';

$option = $_GET["option"] ?? '';

switch ($option) {
    case "guardarCategoria":
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_categoria'])) {
            $nombre = $_POST['nombreCategoria'];    
            $descripcion = $_POST['descripcion'];

            $controller = new CategoriaModel();
            $controller->agregarCategoria($nombre, $descripcion);

            header('Location: mainController.php?option=dashboard&section=categorias');
            exit();
        }
        break;

    case "listarCategoria":
        $categoriasController = new CategoriaModel();
        $categorias = $categoriasController->obtenerCategorias();
        include "../views/categorias/table_categorias.php";
        break;

    case "editarCategoria":  
            $id = $_GET['id'];
            $categoriasController = new CategoriaModel();
            $categoria = $categoriasController->obtenerCategoriaPorId($id);
            include "../views/categorias/modificar_categorias.php";
        break;    

    case "eliminarCategoria":
        $id = $_GET['id'];
        $categoriasController = new CategoriaModel();
        $categoriasController->eliminarCategoria($id);
        header('Location: mainController.php?option=dashboard&section=categorias');
        exit();    

    default:
        echo "Opcion no valida.";
        break;
}

?>