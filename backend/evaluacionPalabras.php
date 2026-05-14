<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
include("db.php");
session_start();

// Validamos que exista el ID para poder guardar en la tabla Progreso
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
    <title>ZIGNA - Evaluación Palabras</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* HEADER */
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .main-logo { height: 35px; }
        .nav-menu { list-style: none; display: flex; gap: 15px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; transition: 0.3s; }
        .nav-menu a:hover { color: #8a4fff; }

        .user-box { display: flex; align-items: center; gap: 15px; }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        /* CONTENIDO */
        .container { max-width: 900px; margin: 30px auto; padding: 0 15px; }
        h2 { text-align: center; margin-bottom: 20px; }

        .btn-volver {
            display: inline-block;
            margin-bottom: 25px;
            padding: 12px 25px;
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(138, 79, 255, 0.3);
        }

        .alerta {
            display: none;
            background: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        /* TARJETAS */
        .question-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .error { border: 2px solid #ff4757; }
        .correcta { border: 2px solid #00c853 !important; }

        .question-header { display: flex; gap: 20px; align-items: center; }
        .question-img {
            width: 120px; height: 120px;
            object-fit: contain; background: #f9f9f9;
            border-radius: 10px;
        }

        .options-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 10px; margin-top: 10px;
        }
        .option {
            border: 1px solid #eee; padding: 10px;
            border-radius: 8px; cursor: pointer; font-size: 14px;
        }

        .btn-main {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white; border: none; padding: 12px 25px;
            border-radius: 20px; font-weight: bold; cursor: pointer;
        }

        .btn-container { text-align: center; margin: 30px 0 50px; }

        .resultado {
            text-align: center; font-size: 22px; font-weight: bold;
            margin-bottom: 20px; padding: 15px; border-radius: 10px; display: none;
        }
        .verde { color: #00c853; background: #e8f5e9; border: 1px solid #00c853; }
        .rojo { color: #ff4757; background: #ffebee; border: 1px solid #ff4757; }
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
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">
    <a href="M_palabras.php" class="btn-volver">← Volver al módulo</a>

    <h2>Evaluación: Palabras LSM</h2>
    <div id="alerta" class="alerta">⚠️ Contesta todas las preguntas antes de finalizar.</div>
    <div id="resultado" class="resultado"></div>
    <div id="preguntas"></div>
    <div class="btn-container" id="btnFinalizar">
        <button class="btn-main" onclick="calificar()">Finalizar Evaluación</button>
    </div>
</div>

<script>
const datos = [
    { id:'p1', correcta:'Hola', img:'imag/palabras/hola.png' },
    { id:'p2', correcta:'Adiós', img:'imag/palabras/adios.png' },
    { id:'p3', correcta:'Buen día', img:'imag/palabras/buen_dia.png' },
    { id:'p4', correcta:'Buenas noches', img:'imag/palabras/buenas_noches.png' },
    { id:'p5', correcta:'Mamá', img:'imag/palabras/mama.png' },
    { id:'p6', correcta:'Papá', img:'imag/palabras/papa.png' },
    { id:'p7', correcta:'Uno', img:'imag/palabras/uno.png' },
    { id:'p8', correcta:'Dos', img:'imag/palabras/dos.png' },
    { id:'p9', correcta:'Cinco', img:'imag/palabras/cinco.png' },
    { id:'p10', correcta:'Diez', img:'imag/palabras/diez.png' }
];

const contenedor = document.getElementById("preguntas");
datos.forEach((p, i) => {
    contenedor.innerHTML += `
    <div class="question-card" id="card-${p.id}">
        <div class="question-header">
            <img src="${p.img}" class="question-img" alt="Seña">
            <div style="flex:1;">
                <p><strong>Pregunta ${i+1}</strong></p>
                <p>¿Qué palabra representa esta seña?</p>
                <div class="options-grid">
                    <label class="option"><input type="radio" name="${p.id}" value="${p.correcta}"> ${p.correcta}</label>
                    <label class="option"><input type="radio" name="${p.id}" value="Incorrecta A"> Opción B</label>
                    <label class="option"><input type="radio" name="${p.id}" value="Incorrecta B"> Opción C</label>
                    <label class="option"><input type="radio" name="${p.id}" value="Incorrecta C"> Opción D</label>
                </div>
            </div>
        </div>
    </div>`;
});

function calificar() {
    let faltantes = false;
    let aciertos = 0;
    document.getElementById("alerta").style.display = "none";
    
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let respondida = false;
        opciones.forEach(op => { if (op.checked) respondida = true; });
        if (!respondida) { card.classList.add("error"); faltantes = true; } 
        else { card.classList.remove("error"); }
    });

    if (faltantes) {
        document.getElementById("alerta").style.display = "block";
        window.scrollTo(0, 0);
        return;
    }

    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        opciones.forEach(op => {
            if (op.checked) {
                if (op.value === p.correcta) { aciertos++; card.classList.add("correcta"); } 
                else { card.classList.add("error"); }
            }
        });
    });

    let porcentaje = Math.round((aciertos / datos.length) * 100);

    // 🔥 ENVÍO A BD CON TUS PARÁMETROS
    const parametros = new URLSearchParams();
    parametros.append('modulo', 'Palabras');
    parametros.append('puntaje', porcentaje);

    fetch('g_puntaje.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: parametros
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            const resultadoDiv = document.getElementById("resultado");
            resultadoDiv.style.display = "block";
            resultadoDiv.innerText = `Resultado: ${porcentaje}% (${aciertos}/10)`;
            resultadoDiv.className = "resultado " + (porcentaje >= 70 ? "verde" : "rojo");
            document.getElementById("btnFinalizar").style.display = "none";
            window.scrollTo(0, 0);
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error al conectar con la base de datos.");
    });
}
</script>
</body>
</html>