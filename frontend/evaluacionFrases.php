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
<<<<<<< HEAD
                <a href="#">Módulos ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="m_abecedario.php">Abecedario</a></li>
                    <li><a href="m_palabras.php">Palabras</a></li>
                    <li><a href="m_frases.php">Frases</a></li>
                </ul>
            </li>
=======

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
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
<<<<<<< HEAD
            <a href="login.php" class="user-link" style="text-decoration:none; color:#666; font-size:13px; font-weight:bold;">
                Cerrar sesión
            </a>
=======
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<div class="evaluacion-container">

    <div class="top-buttons">
<<<<<<< HEAD
        <a href="m_frases.php" class="btn-volver">
            ← Volver al módulo
        </a>
=======

        <a href="m_frases.php" class="btn-volver">
            ← Volver al módulo
        </a>

>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
        <div id="btnProgreso"></div>
    </div>

    <h2>Evaluación: Frases Comunes LSM</h2>

    <div class="barra-progreso">
<<<<<<< HEAD
        <div id="progresoBarra" class="progreso-barra"></div>
    </div>

    <p id="textoProgreso" class="texto-progreso">
        0 de 10 preguntas respondidas
    </p>

    <div id="mensajeError" class="error-evaluacion" style="display: none; color: #ff4d6d; font-size: 22px; font-weight: bold; text-align: center; margin: 20px 0;">
=======
    <div id="progresoBarra" class="progreso-barra"></div>
</div>

<p id="textoProgreso" class="texto-progreso">
    0 de 10 preguntas respondidas
</p>

    <div id="mensajeError" class="mensaje-error">
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
        ⚠️ Contesta todas las preguntas antes de finalizar.
    </div>

    <div id="resultado" class="resultado"></div>

    <div id="modalResultado" class="modal-resultado">
<<<<<<< HEAD
        <div class="modal-contenido">
            <h2 id="tituloModal">🎉 ¡Evaluación completada!</h2>
            <p id="textoModal"></p>
            <button class="btn-main" onclick="cerrarModal()">Continuar</button>
        </div>
    </div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container">
        <button id="btnFinalizar" class="btn-main" onclick="calificar()">
=======

    <div class="modal-contenido">

        <h2 id="tituloModal">
            🎉 ¡Evaluación completada!
        </h2>

        <p id="textoModal"></p>

        <button class="btn-main"
                onclick="cerrarModal()">

            Continuar

        </button>

    </div>

</div>

    <div id="preguntas"></div>

    <div class="evaluacion-btn-container" id="btnFinalizar">
        <button class="btn-main" onclick="calificar()">
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
            Finalizar Evaluación
        </button>
    </div>

</div>

<script src="js/evaluacionFrase.js"></script>

<<<<<<< HEAD
=======
<script src="js/evaluacionFrase.js"></script>

>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
</body>
</html>