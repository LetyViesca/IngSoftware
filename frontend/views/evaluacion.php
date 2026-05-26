<?php 
// 1. CENTRALIZACIÓN DE SEGURIDAD
// Usamos el id_usuario para futuras integraciones con la base de datos
include __DIR__ . '/../../backend/auth.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Evaluación Abecedario</title>
    
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<?php include __DIR__ . '/../components/header.php'; ?>
<div class="evaluacion-container">

    <div class="top-buttons">
        <a href="m_abecedario.php" class="btn-volver">
            ← Volver al módulo
        </a>
        <div id="btnProgreso"></div>
    </div>

    <h2>Evaluación: Abecedario LSM</h2>

    <div class="barra-progreso">
        <div id="progresoBarra" class="progreso-barra"></div>
    </div>

    <p id="textoProgreso" class="texto-previo">
        0 de 10 preguntas respondidas
    </p>    

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
        <button id="btnFinalizar" 
                class="btn-main" 
                onclick="calificar()">
            Finalizar Evaluación
        </button>
    </div>

</div>

<script src="assets/js/evaluacion.js"></script>

</body>
</html>