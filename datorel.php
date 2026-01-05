<?php
    class Database {
        private $hostname = 'localhost';
        private $database = 'nani';
        private $username = 'root';
        private $password = '';

        public function conectar() {
            try {
                $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database;
                $option = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($conexion, $this->username, $this->password, $option);
                return $pdo;
            } catch(PDOException $e) {
                echo 'Error de Conexion :' . $e->getMessage();
                exit;
            }
        }
    }

    // Crear una instancia de la clase Database
    $db = new Database();
    $con = $db->conectar();

    // Verificar si se ha enviado el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consulta SQL para verificar credenciales
        $consulta = $con->prepare("SELECT * FROM torchi WHERE username = ? AND password = ?");
        $consulta->execute([$username, $password]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron resultados
        if ($usuario) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.html"); // Redirigir a la página index.php
            exit;
        } else {
            // Inicio de sesión fallido
            $error = "Usuario o contraseña incorrectos.";
        }
    }
?>