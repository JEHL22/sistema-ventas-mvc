<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/style_login.css">
    <script src="https://kit.fontawesome.com/56a1bbd3e7.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login-card">
        <h3>Login</h3>
        <form action="../controllers/mainController.php?option=proceso-login" method="post">
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                <i class="fa-solid fa-user input-icon"></i>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                <i class="fa-solid fa-lock input-icon"></i>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <div class="mt-3 text-center">
            <a href="../controllers/mainController.php?option=registro" class="btn btn-secondary">Registrar</a>
        </div>
    </div>
</body>
</html>
