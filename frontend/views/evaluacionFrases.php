<?php 
// 1. CONTROL DE SEGURIDAD Y CONEXIÓN CENTRALIZADO
include __DIR__ . '/../../backend/auth.php'; 
include __DIR__ . '/../../backend/db.php'; 

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

<?php include __DIR__ . '/../components/header.php'; ?>
<div class="evaluacion-container">

    <div class="top-buttons">
        <a href="m_frases.php" class="btn-volver">
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