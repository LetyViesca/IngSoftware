<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
include("db.php"); 
session_start();

// Validamos que el usuario esté autenticado para poder guardar el progreso
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Evaluación Frases</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .main-logo { height: 35px; }
        .nav-menu { list-style: none; display: flex; gap: 15px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; transition: 0.3s; }
        .nav-menu a:hover { color: #8a4fff; }

        .user-box { display: flex; align-items: center; gap: 15px; }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        .container { max-width: 900px; margin: 30px auto; padding: 0 15px; }
        h2 { text-align: center; margin-bottom: 25px; }

        .mensaje-error {
            display: none;
            background: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .resultado {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            display: none;
        }

        .question-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .error { border: 2px solid #ff4757; }
        .correcto { border: 2px solid #00c853 !important; }
        .incorrecto { border: 2px solid #ff4757 !important; }

        .question-header { display: flex; gap: 20px; align-items: center; }
        .question-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .option {
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-main {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-volver {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 25px;
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-container { text-align: center; margin-top: 30px; margin-bottom: 50px; }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="inicio.php"><img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna"></a>
        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>
        <div class="user-box">
            <span class="user-name">Estudiante: <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <div style="background:#ff007a; width:35px; height:35px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">
    <a href="frases.php" class="btn-volver">← Volver al módulo</a>

    <h2>Evaluación: Frases Comunes LSM</h2>

    <div id="mensajeError" class="mensaje-error">⚠️ Contesta todas las preguntas antes de finalizar.</div>
    <div id="resultado" class="resultado"></div>
    <div id="preguntas"></div>

    <div class="btn-container" id="btnFinalizar">
        <button class="btn-main" onclick="calificar()">Finalizar Evaluación</button>
    </div>
</div>

<script>
// ✅ SINCRONIZADO CON LOS NOMBRES DE ARCHIVO DE frases.php
const datos = [
    { id:'p1', correcta:'¿Cuál es tu nombre?', img:'imag/frases/nombre.png' },
    { id:'p2', correcta:'De nada', img:'imag/frases/de_nada.png' },
    { id:'p3', correcta:'Ayuda', img:'imag/frases/ayuda.png' },
    { id:'p4', correcta:'Lo siento', img:'imag/frases/lo_siento.png' },
    { id:'p5', correcta:'Tengo sed', img:'imag/frases/sed.png' },
    { id:'p6', correcta:'Con permiso', img:'imag/frases/con_permiso.png' },
    { id:'p7', correcta:'¿De dónde eres?', img:'imag/frases/de_donde.png' },
    { id:'p8', correcta:'¿Cuánto cuesta?', img:'imag/frases/cuanto_cuesta.png' },
    { id:'p9', correcta:'Estoy enfermo', img:'imag/frases/enfermo.png' },
    { id:'p10', correcta:'Me gusta', img:'imag/frases/me_gusta.png' }
];

const contenedor = document.getElementById("preguntas");

datos.forEach((p, i) => {
    contenedor.innerHTML += `
    <div class="question-card" id="card-${p.id}">
        <div class="question-header">
            <img src="${p.img}" class="question-img">
            <div style="flex:1;">
                <p><strong>Pregunta ${i+1}</strong></p>
                <p>¿Qué frase representa esta seña?</p>
                <div class="options-grid">
                    <label class="option"><input type="radio" name="${p.id}" value="${p.correcta}"> ${p.correcta}</label>
                    <label class="option"><input type="radio" name="${p.id}" value="Otras señas"> Otras señas</label>
                    <label class="option"><input type="radio" name="${p.id}" value="No corresponde"> No corresponde</label>
                    <label class="option"><input type="radio" name="${p.id}" value="No sé"> No sé</label>
                </div>
            </div>
        </div>
    </div>`;
});

function calificar() {
    let faltantes = false;
    let aciertos = 0;
    document.getElementById("mensajeError").style.display = "none";

    // 1. Validar que todas estén contestadas
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let respondida = false;
        opciones.forEach(op => { if (op.checked) respondida = true; });

        if (!respondida) {
            card.classList.add("error");
            faltantes = true;
        } else {
            card.classList.remove("error");
        }
    });

    if (faltantes) {
        document.getElementById("mensajeError").style.display = "block";
        window.scrollTo(0, 0);
        return;
    }

    // 2. Calcular aciertos y pintar tarjetas
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        opciones.forEach(op => {
            if (op.checked) {
                if (op.value === p.correcta) {
                    aciertos++;
                    card.classList.add("correcto");
                } else {
                    card.classList.add("incorrecto");
                }
            }
        });
    });

    let porcentaje = Math.round((aciertos / datos.length) * 100);

    // 3. GUARDAR PROGRESO EN BD (RF-08)
    const parametros = new URLSearchParams();
    parametros.append('modulo', 'Frases'); // El nombre que reconoce tu g_puntaje.php
    parametros.append('puntaje', porcentaje);

    fetch('g_puntaje.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: parametros
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            const res = document.getElementById("resultado");
            res.style.display = "block";
            res.innerText = `Resultado: ${aciertos} / 10 (${porcentaje}%)`;
            res.style.color = porcentaje >= 70 ? "#00c853" : "#ff4757";
            res.style.background = porcentaje >= 70 ? "#e8f5e9" : "#ffebee";
            
            document.getElementById("btnFinalizar").style.display = "none";
            window.scrollTo(0, 0);
        } else {
            alert("Error al guardar: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error de conexión al guardar el progreso.");
    });
}
</script>
</body>
</html>