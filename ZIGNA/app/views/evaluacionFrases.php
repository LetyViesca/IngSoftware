<?php 
// 1. CONTROL DE SEGURIDAD Y CONEXIÓN CENTRALIZADO
require_once __DIR__ . '/../auth/auth.php';
require_once __DIR__ . '/../config/db.php';

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
    
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<header>
    <nav>
        <a href="index.php?page=inicio">
            <img src="assets/img/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
        </a>

        <ul class="nav-menu">
            <li><a href="index.php?page=inicio">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Módulos ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="index.php?page=m_abecedario">Abecedario</a></li>
                    <li><a href="index.php?page=m_palabras">Palabras</a></li>
                    <li><a href="index.php?page=m_frases">Frases</a></li>
                </ul>
            </li>
            <li><a href="index.php?page=progreso">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
            <a href="?page=logout" class="user-link" style="text-decoration:none; color:#666; font-size:13px; font-weight:bold;">
                Cerrar sesión
            </a>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<div class="evaluacion-container">

    <div class="top-buttons">
        <a href="index.php?page=m_frases" class="btn-volver">
            ← Volver al módulo
        </a>
        <div id="btnProgreso"></div>
    </div>

    <h2>Evaluación: Frases Comunes LSM</h2>

    <div class="barra-progreso">
        <div id="progresoBarra" class="progreso-barra"></div>
    </div>

    <p id="textoProgreso" class="texto-progreso">
        0 de 10 preguntas respondidas
    </p>

    <div id="mensajeError" class="error-evaluacion" style="display: none; color: #ff4d6d; font-size: 22px; font-weight: bold; text-align: center; margin: 20px 0;">
        ⚠️ Contesta todas las preguntas antes de finalizar.
    </div>

    <div id="resultado" class="resultado"></div>

    <div id="modalResultado" class="modal-resultado">
        <div class="modal-contenido">
            <h2 id="tituloModal">🎉 ¡Evaluación completada!</h2>
            <p id="textoModal"></p>
            <button class="btn-main" onclick="cerrarModal(); window.scrollTo({top: 0, behavior: 'smooth'});">
                Continuar
            </button>
        </div>
    </div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container">
        <button id="btnFinalizar" class="btn-main" onclick="calificar()">
            Finalizar Evaluación
        </button>
    </div>

</div>

<script src="assets/js/evaluacionFrase.js"></script>

</body>
</html>