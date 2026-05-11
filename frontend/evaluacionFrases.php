<?php 
// 1. CONTROL DE SEGURIDAD Y CONEXIÓN CENTRALIZADO
include("../backend/auth.php"); 
include("../backend/db.php"); 

// Recuperamos el ID para el envío de resultados y el nombre para el saludo
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Evaluación Frases</title>
    
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li class="dropdown">

    <a href="#">Módulos ▾</a>

    <ul class="dropdown-menu">

        <li>
            <a href="m_abecedario.php">
                Abecedario
            </a>
        </li>

        <li>
            <a href="m_palabras.php">
                Palabras
            </a>
        </li>

        <li>
            <a href="m_frases.php">
                Frases
            </a>
        </li>

    </ul>

</li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<div class="evaluacion-container">

    <div class="top-buttons">

        <a href="m_frases.php" class="btn-volver">
            ← Volver al módulo
        </a>

        <div id="btnProgreso"></div>
    </div>

    <h2>Evaluación: Frases Comunes LSM</h2>

    <div id="mensajeError" class="mensaje-error">
        ⚠️ Contesta todas las preguntas antes de finalizar.
    </div>

    <div id="resultado" class="resultado"></div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container" id="btnFinalizar">
        <button class="btn-main" onclick="calificar()">
            Finalizar Evaluación
        </button>
    </div>

</div>

<script src="js/evaluacionFrase.js"></script>

<script src="js/evaluacionFrase.js"></script>

</body>
</html>