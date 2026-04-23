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
    <title>ZIGNA - Palabras LSM</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* ===== HEADER (CONSISTENTE CON OTROS MÓDULOS) ===== */
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

        /* ===== CONTENIDO ===== */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .subtitulo {
            margin: 30px 0 15px;
            color: #8a4fff;
            border-left: 5px solid #ff007a;
            padding-left: 10px;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        /* TARJETAS */
        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: 0.25s;
            border: 1px solid #eee;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .img-container {
            height: 160px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .info {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #f9f9f9;
        }

        .info h3 {
            color: #8a4fff;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .info p {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        /* BOTÓN */
        .btn-container {
            text-align: center;
            margin: 50px 0 80px;
        }

        .btn {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            padding: 14px 40px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }
        .btn:hover { opacity: 0.9; transform: scale(1.05); }

        /* RESPONSIVE */
        @media (max-width: 768px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php"><img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA"></a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Estudiante: <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size:13px;">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">

    <h1>Módulo: Palabras LSM</h1>

    <h2 class="subtitulo">Saludos</h2>
    <div class="grid">
        <div class="card">
            <div class="img-container"><img src="imag/palabras/hola.png" alt="Hola"></div>
            <div class="info"><h3>Hola</h3><p>Saludo básico usando movimiento desde la frente.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/adios.png" alt="Adiós"></div>
            <div class="info"><h3>Adiós</h3><p>Movimiento de despedida con la mano.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/buen_dia.png" alt="Buen día"></div>
            <div class="info"><h3>Buen día</h3><p>Se combina “bien” con el gesto de día.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/buenas_noches.png" alt="Buenas noches"></div>
            <div class="info"><h3>Buenas noches</h3><p>Movimiento descendente simulando oscuridad.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/gracias.png" alt="Gracias"></div>
            <div class="info"><h3>Gracias</h3><p>Mano desde la barbilla hacia adelante.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/por_favor.png" alt="Por favor"></div>
            <div class="info"><h3>Por favor</h3><p>Movimiento circular en el pecho.</p></div>
        </div>
    </div>

    <h2 class="subtitulo">Familia</h2>
    <div class="grid">
        <div class="card">
            <div class="img-container"><img src="imag/palabras/mama.png" alt="Mamá"></div>
            <div class="info"><h3>Mamá</h3><p>Seña cerca de la mejilla.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/papa.png" alt="Papá"></div>
            <div class="info"><h3>Papá</h3><p>Se realiza cerca de la frente.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/hermano.png" alt="Hermano"></div>
            <div class="info"><h3>Hermano</h3><p>Movimiento entre ambas manos.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/hermana.png" alt="Hermana"></div>
            <div class="info"><h3>Hermana</h3><p>Similar a hermano pero con variación.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/abuelo.png" alt="Abuelo"></div>
            <div class="info"><h3>Abuelo</h3><p>Movimiento desde la frente hacia adelante.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/hijo.png" alt="Hijo"></div>
            <div class="info"><h3>Hijo</h3><p>Movimiento desde el vientre hacia adelante.</p></div>
        </div>
    </div>

    <h2 class="subtitulo">Números</h2>
    <div class="grid">
        <div class="card">
            <div class="img-container"><img src="imag/palabras/uno.png" alt="Uno"></div>
            <div class="info"><h3>Uno</h3><p>Dedo índice levantado.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/dos.png" alt="Dos"></div>
            <div class="info"><h3>Dos</h3><p>Índice y medio levantados.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/tres.png" alt="Tres"></div>
            <div class="info"><h3>Tres</h3><p>Tres dedos levantados.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/cuatro.png" alt="Cuatro"></div>
            <div class="info"><h3>Cuatro</h3><p>Cuatro dedos extendidos.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/cinco.png" alt="Cinco"></div>
            <div class="info"><h3>Cinco</h3><p>Mano completamente abierta.</p></div>
        </div>
        <div class="card">
            <div class="img-container"><img src="imag/palabras/diez.png" alt="Diez"></div>
            <div class="info"><h3>Diez</h3><p>Movimiento del puño cerrado.</p></div>
        </div>
    </div>

    <div class="btn-container">
        <a href="evaluacionPalabras.php" class="btn">Comenzar Evaluación ✨</a>
    </div>

</div>

</body>
</html>