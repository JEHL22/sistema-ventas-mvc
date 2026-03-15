<!-- views/dashboard.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .dashboard-item img {
            max-width: 80px;
            max-height: 80px;
            margin-bottom: 10px;
            transition: transform 0.3s;
        }
        .dashboard-item:hover img {
            transform: scale(1.1);
        }
        .dashboard-item {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }
        .dashboard-item:hover {
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.15);
        }
        .dashboard-item p {
            margin: 0;
            color: #007bff;
            font-weight: bold;
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Sistema de gestionamiento</h1>
        <div class="dashboard-container">
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=empleados" class="text-decoration-none">
                    <img src="../views/img/empleados.png" class="img-fluid" alt="Empleados">
                    <p>Empleados</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=clientes" class="text-decoration-none">
                    <img src="../views/img/clientes.png" class="img-fluid" alt="Clientes">
                    <p>Clientes</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=productos" class="text-decoration-none">
                    <img src="../views/img/productos.png" class="img-fluid" alt="Productos">
                    <p>Productos</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=categorias" class="text-decoration-none">
                    <img src="../views/img/categorias.png" class="img-fluid" alt="Categorías">
                    <p>Categorías</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=proveedores" class="text-decoration-none">
                    <img src="../views/img/proveedores.png" class="img-fluid" alt="Proveedores">
                    <p>Proveedores</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=expedidores" class="text-decoration-none">
                    <img src="../views/img/expedidores.png" class="img-fluid" alt="Expedidores">
                    <p>Expedidores</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=pedidos" class="text-decoration-none">
                    <img src="../views/img/pedidos.png" class="img-fluid" alt="Pedidos">
                    <p>Pedidos</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 text-center dashboard-item">
                <a href="mainController.php?option=dashboard&section=detallespedidos" class="text-decoration-none">
                    <img src="../views/img/detallesPedidos.png" class="img-fluid" alt="Detalles Pedidos">
                    <p>Detalles Pedidos</p>
                </a>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="mainController.php?option=logout" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>
