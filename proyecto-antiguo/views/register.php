<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/style_register.css">
</head>
<body>
<div class="register-card">
        <h3>Registro</h3>
        <form action="../controllers/mainController.php?option=proceso-registro" method="post">
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                <i class="fa-solid fa-user input-icon"></i>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                <i class="fa-solid fa-envelope input-icon"></i>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                <i class="fa-solid fa-user input-icon"></i>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                <i class="fa-solid fa-lock input-icon"></i>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="codigoAdmin" name="codigoAdmin" placeholder="Código de Administrador" required>
                <i class="fa-solid fa-lock input-icon"></i>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <div class="mt-3 text-center">
            <a href="../controllers/mainController.php?option=login" class="btn btn-secondary">Volver al Login</a>
        </div>
    </div>
</body>
</html>
