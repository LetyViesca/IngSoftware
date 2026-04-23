<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
include("db.php"); 
session_start();

// Validamos que el usuario esté autenticado para cargar su nombre y guardar progreso
if (!isset($_SESSION['id_usuario'])) {
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
    <title>ZIGNA - Frases LSM</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* HEADER */
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; }
        .main-logo { height: 35px; }

        .nav-menu {
            list-style: none;
            display: flex;
            gap: 15px;
        }
        
        .nav-menu a { text-decoration: none; color: #333; font-size: 14px; }
        .nav-menu a:hover { color: #8a4fff; }

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-link { text-decoration: none; color: #666; font-size: 13px; }

        /* CONTENIDO */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h1 {
            text-align: center;
            margin: 20px 0 30px;
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
        }

        /* IMÁGENES UNIFORMES */
        .img-container {
            height: 160px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* TEXTO */
        .info {
            padding: 12px;
            text-align: center;
        }

        .info h3 {
            color: #8a4fff;
            margin-bottom: 5px;
        }

        .info p {
            font-size: 13px;
            color: #555;
        }

        /* BOTÓN */
        .btn-container {
            text-align: center;
            margin: 40px 0;
        }

        .btn {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            padding: 12px 25px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 480px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="inicio.php"><img src="imag/Logo_Zigna.png" class="main-logo" alt="Zigna Logo"></a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span style="font-size: 13px; color: #555;">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" class="user-link">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">

    <h1>Módulo: Frases LSM</h1>

    <div class="grid">
        <div class="card">
            <div class="img-container"><img src="imag/frases/nombre.png"></div>
            <div class="info"><h3>¿Cuál es tu nombre?</h3><p>Pregunta usando configuración "L" y señalando a la persona.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/de_nada.png"></div>
            <div class="info"><h3>De nada</h3><p>Mano abierta desde la barbilla se desliza hacia adelante.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/ayuda.png"></div>
            <div class="info"><h3>Ayuda</h3><p>Puño cerrado sobre palma abierta, ambas manos suben juntas.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/lo_siento.png"></div>
            <div class="info"><h3>Lo siento</h3><p>Mano en puño frotando en círculos sobre el pecho.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/sed.png"></div>
            <div class="info"><h3>Tengo sed</h3><p>Dedos en "V" desde la garganta bajan por el cuello.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/con_permiso.png"></div>
            <div class="info"><h3>Con permiso</h3><p>Mano en "5" pasa entre índice y medio de la otra mano.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/de_donde.png"></div>
            <div class="info"><h3>¿De dónde eres?</h3><p>Dedos índice y pulgar juntos tocan la barbilla y luego apuntan al frente.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/cuanto_cuesta.png"></div>
            <div class="info"><h3>¿Cuánto cuesta?</h3><p>Ambas manos en "O" chocan varias veces.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/enfermo.png"></div>
            <div class="info"><h3>Estoy enfermo</h3><p>Mano en la frente y otra en el estómago.</p></div>
        </div>

        <div class="card">
            <div class="img-container"><img src="imag/frases/me_gusta.png"></div>
            <div class="info"><h3>Me gusta</h3><p>Mano desde el pecho hacia adelante con sonrisa.</p></div>
        </div>
    </div>

    <div class="btn-container">
        <a href="evaluacionFrases.php" class="btn">Evaluación ✨</a>
    </div>

</div>

</body>
</html>