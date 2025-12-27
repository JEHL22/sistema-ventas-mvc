<?php
if (!isset($_SESSION['user'])) {
    header("Location: controllers/mainController.php?option=login");
    session_unset();
    session_destroy();
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Layout</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../styles.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/56a1bbd3e7.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include '../views/shared/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include '../views/shared/dashboard.php'; ?>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <button type="button" id="myBtn" class="btn btn-primary">Agregar</button>
                    <input type="text" class="form-control w-25" placeholder="BUSCADOR">
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                            function includeController($controller, $option) {
                                $_GET['option'] = $option;
                                include $controller;
                            }

                            $section = $_GET['section'] ?? null;
                            switch ($section) {
                                case "categorias":
                                    includeController("../controllers/categoriaController.php", "listarCategoria");
                                    break;
                                case "clientes":
                                    includeController("../controllers/clientesController.php", "listarClientes");
                                    break;
                                case "detallespedidos":
                                    includeController("../controllers/detallespedidosController.php", "listarDetallesPedidos");
                                    break;
                                case "empleados":
                                    includeController("../controllers/empleadosController.php", "listarEmpleados");
                                    break;
                                case"expedidores":
                                    includeController("../controllers/expedidoresController.php", "listarExpedidores");
                                    break;
                                case "pedidos":
                                    includeController("../controllers/pedidosController.php", "listarPedidos");
                                    break;    
                                case "productos":
                                    includeController("../controllers/productosController.php", "listarProductos");
                                    break;    
                                case "proveedores":    
                                    includeController("../controllers/proveedoresController.php", "listarProveedores");
                                    break;        
                                default:
                                    echo "Selecciona una sección del menú.";
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    // Cargar el formulario correspondiente según la URL
                    switch ($section) {
                        case "categorias":
                            include "../views/categorias/form_categorias.php";
                            break;
                        case "clientes":
                            include "../views/clientes/form_clientes.php";
                            break;
                        case "detallespedidos":
                            include "../views/detallespedidos/form_detallespedidos.php";
                            break;   
                        case "empleados":
                            include "../views/empleados/form_empleados.php";
                            break;
                        case"expedidores":
                            include "../views/expedidores/form_expedidores.php";
                            break;
                        case "pedidos":
                            include "../views/pedidos/form_pedidos.php";
                            break;    
                        case "productos":
                            include "../views/productos/form_productos.php";
                            break;    
                        case "proveedores":    
                            include "../views/proveedores/form_proveedores.php";
                            break;
                        default:
                            echo "Selecciona una sección del menú.";
                            break;
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('myBtn').addEventListener('click', function() {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
</body>
</html>
