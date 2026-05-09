<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
include("../backend/db.php");

session_start();

// Validamos que el usuario esté autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZIGNA - Evaluación Frases</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>

    <nav>

        <a href="inicio.php">

            <img src="imag/Logo_Zigna.png"
                 class="main-logo"
                 alt="Logo Zigna">

        </a>

        <ul class="nav-menu">

            <li><a href="inicio.php">Inicio</a></li>

            <li><a href="modulos.php">Módulos</a></li>

            <li><a href="progreso.php">Progreso</a></li>

        </ul>

        <div class="user-box">

            <span class="user-name">

                Hola,
                <?php echo htmlspecialchars($nombre_usuario); ?>

            </span>

            <div class="user-icon">👤</div>

        </div>

    </nav>

</header>

<div class="evaluacion-container">

    <a href="M_frases.php"
       class="btn-volver">

       ← Volver al módulo

    </a>

    <h2>
        Evaluación: Frases Comunes LSM
    </h2>

    <div id="mensajeError"
         class="mensaje-error">

         ⚠️ Contesta todas las preguntas antes de finalizar.

    </div>

    <div id="resultado"
         class="resultado">

    </div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container"
         id="btnFinalizar">

        <button class="btn-main"
                onclick="calificar()">

            Finalizar Evaluación

        </button>

    </div>

</div>

<script src="evaluacionFrase.js"></script>

</body>
</html>