<?php
session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Evaluación</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script_abc.js"></script>

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script_abc.js"></script>
    
</head>

<body>

<header>
    <nav>

        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png"
                 class="main-logo">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">

            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>

            <a href="login.php"
               style="text-decoration:none; color:#666; font-size:13px;">
               Cerrar sesión
            </a>

            <div class="user-icon">👤</div>

        </div>
    </nav>
</header>

<div class="evaluacion-container">

    <div class="btn-back">
        <a href="M_abecedario.php" class="btn-main">
            ⬅ Volver al módulo
        </a>
    </div>

    <h2>Evaluación: Abecedario LSM</h2>

    <div id="resultado" class="resultado"></div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container">
        <button id="btnFinalizar"
                class="btn-main"
                onclick="calificar()">
            Finalizar Evaluación
        </button>
    </div>

</div>

<script src="evaluacion.js"></script>

</body>
</html>