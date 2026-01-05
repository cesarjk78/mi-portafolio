<?php
    require 'databaselog.php';
    
    // Verificar si se ha enviado el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Realizar la conexión a la base de datos
        $db = new Database();
        $con = $db->conectar();
        
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consultar la base de datos para verificar las credenciales
        $consulta = $con->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
        $consulta->execute([$username, $password]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($usuario) {
            // Iniciar sesión y redirigir al usuario a otra página
            session_start();
            $_SESSION['username'] = $username;
            header("Location: brujainicio.php");
            exit;
        } else {
            // Si las credenciales son incorrectas, mostrar un mensaje de error
            $error = "Usuario o contraseña incorrectos";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="terreneitor.css">
</head>
<body>
        
    <div class="container">
        <div class="container-form">
            <form class="sign-in" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Iniciar Sesión</h2>
                <div class="social-networks">
                    <ion-icon name="logo-twitch"></ion-icon>
                    <ion-icon name="logo-twitter"></ion-icon>
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-tiktok"></ion-icon>
                </div>
                <span>Use su correo y contraseña</span>
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" placeholder="Email" name="username" required>
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button class="button" type="submit">INICIAR SESIÓN</button>
                <a href="register.php">Registrarse</a>
            </form>
        </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
