<?php
    require 'databaselog.php';
    
    // Verificar si se ha enviado el formulario de registro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Realizar la conexión a la base de datos
        $db = new Database();
        $con = $db->conectar();
        
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consultar la base de datos para verificar si el nombre de usuario ya existe
        $consulta = $con->prepare("SELECT * FROM usuarios WHERE username = :username");
        $consulta->execute(['username' => $username]);
        $usuario_existente = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario ya existe
        if ($usuario_existente) {
            $error = "El nombre de usuario ya está en uso.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $stmt = $con->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);
            // Redirigir al usuario a la página de inicio de sesión o a otra página según sea necesario
            header("Location: login.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="texas.css">
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form class="sign-up" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Registrarse</h2>
                <div class="container-input">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="container-input">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button class="button" type="submit">Registrarse</button>
                <a href="login.php">Login</a>
            </form>
            <?php
                // Mostrar mensaje de error si existe
                if (isset($error)) {
                    echo "<p>$error</p>";
                }
            ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
