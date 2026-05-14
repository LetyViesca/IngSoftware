<?php
session_start();
include("db.php");

// Seguridad: Si no hay sesión, al login
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
    <style>
        /* RNF-03: Diseño Responsive 360px */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; padding-bottom: 50px; }
        
        header { background: white; padding: 15px 5%; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .logo { height: 30px; }

        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        h2 { text-align: center; margin-bottom: 25px; color: #333; }

        .question-card {
            background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px;
            border: 2px solid transparent; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* Validaciones Visuales (Rojo para error) */
        .card-error { border-color: #ff4757 !important; background-color: #fff5f5; }
        .msg-error-banner { 
            background: #ff4757; color: white; padding: 15px; border-radius: 10px; 
            margin-bottom: 20px; text-align: center; display: none; font-weight: bold;
        }

        .question-header { display: flex; gap: 20px; align-items: center; }
        .question-img { width: 100px; height: 100px; object-fit: contain; background: #f9f9f9; border-radius: 10px; }

        .options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px; }
        .option { 
            border: 1px solid #ddd; padding: 12px; border-radius: 10px; 
            cursor: pointer; display: flex; align-items: center; gap: 10px; font-size: 14px;
        }
        .option:hover { background: #f0f0f0; }

        .btn-finalizar {
            width: 100%; background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white; border: none; padding: 15px; border-radius: 30px;
            font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px;
        }

        /* Ajuste Responsive 360px */
        @media (max-width: 480px) {
            .question-header { flex-direction: column; text-align: center; }
            .options-grid { grid-template-columns: 1fr; }
            header { padding: 10px 2%; }
            .user-info { display: none; } /* Ahorrar espacio en móvil */
        }
    </style>
</head>
<body>

<header>
    <img src="imag/Logo_Zigna.png" class="logo">
    <div class="user-info">Hola, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong></div>
</header>

<div class="container">
    <div id="errorBanner" class="msg-error-banner"> Por favor, responde todas las preguntas antes de continuar.</div>
    
    <h2>Evaluación: Abecedario LSM</h2>

    <form id="formEvaluacion">
        <div class="question-card" id="card-p1">
            <div class="question-header">
                <img src="imag/abecedario/a.png" class="question-img">
                <div>
                    <p><strong>Pregunta 1</strong></p>
                    <p>¿Qué letra representa esta seña?</p>
                </div>
            </div>
            <div class="options-grid">
                <label class="option"><input type="radio" name="p1" value="A"> Opción A</label>
                <label class="option"><input type="radio" name="p1" value="B"> Opción B</label>
                <label class="option"><input type="radio" name="p1" value="C"> Opción C</label>
                <label class="option"><input type="radio" name="p1" value="D"> Opción D</label>
            </div>
        </div>

        <div class="question-card" id="card-p2">
            <div class="question-header">
                <img src="imag/abecedario/b.png" class="question-img">
                <div>
                    <p><strong>Pregunta 2</strong></p>
                    <p>¿Qué letra representa esta seña?</p>
                </div>
            </div>
            <div class="options-grid">
                <label class="option"><input type="radio" name="p2" value="A"> Opción A</label>
                <label class="option"><input type="radio" name="p2" value="B"> Opción B</label>
                <label class="option"><input type="radio" name="p2" value="C"> Opción C</label>
                <label class="option"><input type="radio" name="p2" value="D"> Opción D</label>
            </div>
        </div>

        <button type="button" class="btn-finalizar" onclick="validarEvaluacion()">Finalizar Evaluación</button>
    </form>
</div>

<script>
function validarEvaluacion() {
    const preguntas = ["p1", "p2"]; // Agrega aquí todos los names de tus preguntas
    let faltantes = false;
    const banner = document.getElementById("errorBanner");

    preguntas.forEach(id => {
        const opciones = document.getElementsByName(id);
        const card = document.getElementById("card-" + id);
        let respondida = false;

        // Revisar si alguna opción está marcada
        opciones.forEach(opt => {
            if (opt.checked) respondida = true;
        });

        if (!respondida) {
            card.classList.add("card-error");
            faltantes = true;
        } else {
            card.classList.remove("card-error");
        }
    });

    if (faltantes) {
        banner.style.display = "block";
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        banner.style.display = "none";
        alert("¡Evaluación completada con éxito! Procesando resultados...");
        // Aquí puedes redirigir o enviar por AJAX
    }
}
</script>

</body>
</html>
