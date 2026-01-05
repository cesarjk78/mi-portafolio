<?php
    require 'datorel.php';
    
    // Verificar si se ha enviado el formulario de registro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Realizar la conexión a la base de datos
        $db = new Database();
        $con = $db->conectar();
        
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consultar la base de datos para verificar si el nombre de usuario ya existe
        $consulta = $con->prepare("SELECT * FROM torchi WHERE username = :username");
        $consulta->execute(['username' => $username]);
        $usuario_existente = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario ya existe
        if ($usuario_existente) {
            $error = "El nombre de usuario ya está en uso.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $stmt = $con->prepare("INSERT INTO torchi (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);
            // Redirigir al usuario a la página de inicio de sesión o a otra página según sea necesario
            header("Location: ou.php");
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
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos adicionales */
        .huge-title {
            font-size: 4em;
            text-align: center;
            margin-top: 50px;
        }

        .big-paragraph {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 20px;
        }

        .comment-textarea {
    width: 80%; /* Ajusta el ancho del textarea */
    height: 200px; /* Ajusta la altura del textarea */
    margin: 0 auto; /* Centra el textarea horizontalmente */
    display: block; /* Cambia el elemento a un bloque para aplicar márgenes y centrado */
    resize: vertical; /* Permite que el usuario redimensione verticalmente el textarea */
    padding: 10px; /* Añade espacio dentro del textarea */
}



        
    </style>
</head>
<body>
    <header class="container-hero">
        <div class="container hero">
            <div class="customer-support">
                <i class="fa-solid fa-headset"></i>
                <div class="content-customer-support">
                    <span class="text">Soporte al cliente</span>
                    <span class="number">123-456-7890</span>
                </div>
            </div>

            <div class="container-logo">
                <i class="fas fa-shield-alt"></i>
                <h1 class="logo"><a href="/">Security Support</a></h1>
            </div>

            <div class="container-user">
                <i class="fa-solid fa-user"></i>
                <i class="fa-solid fa-basket-shopping"></i>
                <div class="content-shopping-cart">
                    <span class="text">Carrito</span>
                    <span class="number">(0)</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container-navbar">
        <nav class="navbar container">
            <i class="fa-solid fa-bars"></i>
            <ul class="menu">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="quienesomos.html">Quiénes somos?</a></li>
                <li><a href="ou.php">Comentarios</a></li>
                <li><a href="contador.html">I.A proximos</a></li>
                <li><a href="index.php">Lista de Productos</a></li>
                <li><a href="blogs.html">Mas blogs</a></li>
            </ul>

            <form class="search-form">
                <input type="search" placeholder="Buscar...">
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </nav>
    </div>
    <div class="container">
        <div class="container-form">
        <form class="sign-up" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Agregar comentario</h2>
    <div class="container-input">
    <label for="username" style="font-size: 20px;">Nombre de usuario:</label>
    <input type="text" id="username" name="username" style="font-size: 18px;" required>
</div>
<div class="container-input">
    <label for="comment" style="font-size: 20px;">Comentario:</label>
    <textarea id="comment" name="comment" rows="5" cols="40" class="comment-textarea" style="font-size: 18px;" required></textarea>
</div>

    <button class="button" type="submit">Enviar comentario</button>
</form>

            <?php
                // Mostrar mensaje de error si existe
                if (isset($error)) {
                    echo "<p>$error</p>";
                }
            ?>
        </div>
    </div>
    <footer class="footer">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección: 71 Pennington Lane Vernon Rockville, CT
								06066
							</li>
							<li>Teléfono: 123-456-7890</li>
							<li>Fax: 55555300</li>
							<li>EmaiL: security@support.com</li>
						</ul>
						<div class="social-icons">
							<span class="facebook">
								<i class="fa-brands fa-facebook-f"></i>
							</span>
							<span class="twitter">
								<i class="fa-brands fa-twitter"></i>
							</span>
							<span class="youtube">
								<i class="fa-brands fa-youtube"></i>
							</span>
							<span class="pinterest">
								<i class="fa-brands fa-pinterest-p"></i>
							</span>
							<span class="instagram">
								<i class="fa-brands fa-instagram"></i>
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>
							<li><a href="#">Información Delivery</a></li>
							<li><a href="#">Politicas de Privacidad</a></li>
							<li><a href="#">Términos y condiciones</a></li>
							<li><a href="#">Contactános</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Historial de ordenes</a></li>
							<li><a href="#">Lista de deseos</a></li>
							<li><a href="#">Boletín</a></li>
							<li><a href="#">Reembolsos</a></li>
						</ul>
					</div>

					<div class="newsletter">
						<p class="title-footer">Boletín informativo</p>

						<div class="content">
							<p>
								Suscríbete a nuestros boletines ahora y mantente al
								día con nuevas colecciones y ofertas exclusivas.
							</p>
							<input type="email" placeholder="Ingresa el correo aquí...">
							<button>Suscríbete</button>
						</div>
					</div>
				</div>

				<div class="copyright">
					<p>
                       Desarrollado por Security Suport &copy; 2024
					</p>

					<img src="img/payment.png" alt="Pagos">
				</div>
			</div>
		</footer>

		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
	</body>
</html>


    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
