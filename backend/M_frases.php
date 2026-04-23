<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
session_start();

// Validamos que el usuario esté autenticado
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
    <title>ZIGNA - Frases Comunes LSM</title>

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

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        /* CONTENIDO */
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h1 {
            text-align: center;
            margin: 20px 0 30px;
            color: #333;
        }

        .palabras-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .card-palabra {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: 0.25s;
            border: 1px solid #eee;
        }

        .card-palabra:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .img-container {
            height: 150px;
            background: #fff;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* QA: Asegura que no se corten las manos en la seña */
        }

        .badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #8a4fff;
            color: white;
            font-size: 10px;
            padding: 3px 10px;
            border-radius: 10px;
            font-weight: bold;
        }

        .info-palabra {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #f9f9f9;
        }

        .info-palabra h3 {
            color: #8a4fff;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .info-palabra p {
            font-size: 11px;
            color: #666;
            text-align: center;
            line-height: 1.4;
        }

        /* 🔥 BOTÓN CON DEGRADADO ZIGNA */
        .btn-ready {
            display: inline-block;
            margin: 40px auto 60px;
            padding: 12px 35px;
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(255, 0, 122, 0.2);
        }

        .btn-ready:hover {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 0, 122, 0.3);
        }

        .btn-container {
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .palabras-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .palabras-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size:12px;">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">
    <h1>Módulo: Frases Comunes LSM</h1>

    <div class="palabras-grid" id="grid"></div>

    <div class="btn-container">
        <a href="evaluacionFrases.php" class="btn-ready">Comenzar Evaluación ✨</a>
    </div>
</div>

<script>
/* ✅ DATOS DE FRASES */
const frases = [
    ["¡Hola!", "Se hace la letra 'H' con la mano dominante y se toca la sien con el dedo índice y medio. La mano se mueve hacia afuera.", "hola.png"],
    ["Buen día", "Seña compuesta: Primero 'Bien' (mano al pecho) y luego se forma una 'D' que sube representando el sol.", "buen_dia.png"],
    ["Buenas noches", "Seña compuesta: Primero 'Bien' y luego ambas manos bajan simulando que cae la oscuridad.", "buenas_noches.png"],
    ["¿Cuál es tu nombre?", "Se hace la letra 'N' con ambas manos y se balancean ligeramente de lado a lado.", "cual_es_tu_nombre.png"],
    ["Tengo sed", "Se hace una forma de 'C' con la mano y se desliza por la garganta hacia abajo.", "tengo_sed.png"],
    ["Gracias", "La mano dominante toca la barbilla y se mueve hacia adelante con suavidad.", "gracias.png"],
    ["De nada", "Primero se forma una 'D' y luego la mano se mueve de lado a lado frente al pecho.", "de_nada.png"],
    ["Por favor", "La mano dominante sobre el pecho realiza movimientos circulares constantes.", "por_favor.png"],
    ["Ayuda", "Un puño presiona la palma de la otra mano hacia abajo con firmeza.", "ayuda.png"],
    ["Lo siento", "Un puño cerrado sobre el pecho realiza movimientos circulares de arrepentimiento.", "lo_siento.png"]
];

const grid = document.getElementById("grid");

/* 🔥 GENERAR TARJETAS DINÁMICAMENTE */
frases.forEach(f => {
    grid.innerHTML += `
    <div class="card-palabra">
        <div class="img-container">
            <span class="badge">LSM</span>
            <img src="imag/frases/${f[2]}" alt="${f[0]}">
        </div>
        <div class="info-palabra">
            <h3>${f[0]}</h3>
            <p>${f[1]}</p>
        </div>
    </div>
    `;
});
</script>

</body>
</html>