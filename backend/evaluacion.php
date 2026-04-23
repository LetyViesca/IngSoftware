<?php
// 1. INICIO DE SESIÓN Y SEGURIDAD
session_start();

// Si el usuario no ha iniciado sesión, lo redirigimos al login
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
    <title>ZIGNA - Evaluación Abecedario</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* HEADER */
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .main-logo { height: 35px; }
        .nav-menu { list-style: none; display: flex; gap: 15px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; }

        .user-box { display: flex; align-items: center; gap: 15px; }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        /* CONTENIDO */
        .container { max-width: 900px; margin: 30px auto; padding: 0 15px; }
        h2 { text-align: center; margin-bottom: 25px; }

        .question-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        .question-header { display: flex; gap: 20px; align-items: center; }
        .question-img { 
            width: 120px; height: 120px; object-fit: contain; 
            background: #eee; border-radius: 10px; 
        }

        .options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px; }
        .option { border: 1px solid #eee; padding: 10px; border-radius: 8px; cursor: pointer; display: block; }

        /* ESTADOS CRÍTICOS */
        .error { border: 2px solid #ff4757 !important; background-color: #fff5f5; }
        .correct { border: 2px solid #2ecc71 !important; }
        .incorrect { border: 2px solid #ff4757 !important; }

        .resultado { text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 20px; }

        .btn-main {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white; border: none; padding: 12px 25px;
            border-radius: 20px; font-weight: bold; cursor: pointer;
            text-decoration: none; display: inline-block;
        }

        .btn-container { text-align: center; margin-top: 30px; }
        .btn-back { margin-bottom: 20px; }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php"><img src="imag/Logo_Zigna.png" class="main-logo"></a>
        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>
        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size: 13px;">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="btn-back">
        <a href="M_abecedario.php"><button class="btn-main">⬅ Volver al módulo</button></a>
    </div>

    <h2>Evaluación: Abecedario LSM</h2>
    <div id="resultado" class="resultado"></div>
    <div id="preguntas"></div>

    <div class="btn-container">
        <button id="btnFinalizar" class="btn-main" onclick="calificar()">Finalizar Evaluación</button>
    </div>
</div>

<script>
const datos = [
    { id:'p1', correcta:'A', img:'imag/abecedario/a.png' },
    { id:'p2', correcta:'B', img:'imag/abecedario/b.png' },
    { id:'p3', correcta:'C', img:'imag/abecedario/c.png' },
    { id:'p4', correcta:'D', img:'imag/abecedario/d.png' },
    { id:'p5', correcta:'E', img:'imag/abecedario/e.png' },
    { id:'p6', correcta:'F', img:'imag/abecedario/f.png' },
    { id:'p7', correcta:'G', img:'imag/abecedario/g.png' },
    { id:'p8', correcta:'H', img:'imag/abecedario/h.png' },
    { id:'p9', correcta:'I', img:'imag/abecedario/i.png' },
    { id:'p10', correcta:'J', img:'imag/abecedario/j.png' }
];

const contenedor = document.getElementById("preguntas");

// Renderizar preguntas
datos.forEach((p, i) => {
    contenedor.innerHTML += `
    <div class="question-card" id="card-${p.id}">
        <div class="question-header">
            <img src="${p.img}" class="question-img">
            <div style="flex:1;">
                <p><strong>Pregunta ${i+1}</strong></p>
                <p>¿Qué letra es esta?</p>
                <div class="options-grid">
                    <label class="option"><input type="radio" name="${p.id}" value="A"> A</label>
                    <label class="option"><input type="radio" name="${p.id}" value="B"> B</label>
                    <label class="option"><input type="radio" name="${p.id}" value="C"> C</label>
                    <label class="option"><input type="radio" name="${p.id}" value="D"> D</label>
                </div>
            </div>
        </div>
    </div>
    `;
});

function calificar() {
    let faltantes = false;
    let aciertos = 0;
    const resultado = document.getElementById("resultado");

    // Limpiar estados previos
    resultado.innerText = "";

    // VALIDACIÓN: Comprobar si faltan respuestas
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let respondida = false;

        card.classList.remove("error", "correct", "incorrect");

        opciones.forEach(op => {
            if (op.checked) respondida = true;
        });

        if (!respondida) {
            card.classList.add("error");
            faltantes = true;
        }
    });

    // BLOQUEO: Si falta alguna, no permite continuar
    if (faltantes) {
        resultado.innerText = "⚠️ Contesta todas las preguntas antes de finalizar.";
        resultado.style.color = "#ff4757";
        window.scrollTo(0, 0);
        return; // Detiene la ejecución aquí
    }

    // CALIFICACIÓN: Si todo está lleno, procesamos resultados
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let seleccionada = "";

        opciones.forEach(op => {
            if (op.checked) seleccionada = op.value;
        });

        if (seleccionada === p.correcta) {
            aciertos++;
            card.classList.add("correct");
        } else {
            card.classList.add("incorrect");
        }
    });

    let porcentaje = Math.round((aciertos / datos.length) * 100);
    resultado.innerText = "Resultado: " + porcentaje + "% (" + aciertos + "/10)";
    resultado.style.color = porcentaje >= 70 ? "#2ecc71" : "#ff4757";

    // Ocultar botón solo tras una evaluación completa
    document.getElementById("btnFinalizar").style.display = "none";
    window.scrollTo(0, 0);
}
</script>

</body>
</html>