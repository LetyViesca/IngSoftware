<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
session_start();

// Si el usuario no tiene una sesión activa, lo redirigimos al login
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

// Guardamos el nombre para usarlo en el saludo
$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Inicio</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #fcfcfc; overflow-x: hidden; }
        
        /* ===== HEADER (INTEGRADO PHP) ===== */
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; width: 100%; }
        nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; }
        .main-logo { height: 35px; }

        .nav-menu {
            list-style: none;
            display: flex;
            gap: 15px;
            font-size: 14px;
        }
        .nav-menu a { text-decoration: none; color: #333; transition: 0.3s; }
        .nav-menu a:hover { color: #8a4fff; }

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        .user-icon {
            background: #ff007a;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        /* ===== HERO ===== */
        .hero-section { padding: 20px 5%; }
        .hero-card { background: white; padding: 25px; border-radius: 20px; border: 1px solid #eee; box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
        .zigna-text { color: #8a4fff; font-weight: bold; }

        /* ===== GRID ===== */
        .learning-guide { padding: 0 5% 40px; }
        .card-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }

        .module-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: 0.3s;
        }
        .module-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

        .img-container {
            position: relative;
            width: 100%;
            height: 180px;
            background: #f9f9f9;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Cambiado a contain para ver bien las señas */
            display: block;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card-info { padding: 15px; }

        .btn {
            width: 100%;
            border: none;
            padding: 12px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { opacity: 0.9; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA Logo">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            
            <a href="login.php" style="text-decoration:none; color:#666; font-size:14px; font-weight: 600;">
                Cerrar sesión
            </a>

            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<main>

<section class="hero-section">
    <div class="hero-card">
        <h1>
            Sigue el aprendizaje en <span class="zigna-text">ZIGNA</span>
        </h1>
        <p style="color:#666;">
            Aprende Lengua de Señas Mexicana y mejora tu comunicación de manera interactiva.
        </p>
    </div>
</section>

<section class="learning-guide">
    <div class="card-grid">

        <div class="module-card">
            <div class="img-container">
                <span class="badge">A</span>
                <img src="imag/abecedario/a.png" class="card-img" alt="Abecedario">
            </div>

            <div class="card-info">
                <h3>El Abecedario</h3>
                <p style="font-size:13px; color:#666; margin:10px 0;">
                    Aprende cada letra para deletrear nombres y palabras comunes.
                </p>

                <a href="M_abecedario.php" style="text-decoration: none;">
                    <button class="btn" style="background:#8a4fff">
                        ▶ Seguir aprendiendo
                    </button>
                </a>
            </div>
        </div>

        <div class="module-card">
            <div class="img-container">
                <span class="badge">P</span>
                <img src="imag/palabras/uno.png" class="card-img" alt="Palabras">
            </div>

            <div class="card-info">
                <h3>Palabras Clave</h3>
                <p style="font-size:13px; color:#666; margin:10px 0;">
                    Aprende palabras básicas y vocabulario esencial del día a día.
                </p>

                <a href="M_palabras.php" style="text-decoration: none;">
                    <button class="btn" style="background:#00c2a8">
                        ▶ Seguir aprendiendo
                    </button>
                </a>
            </div>
        </div>

        <div class="module-card">
            <div class="img-container">
                <span class="badge">F</span>
                <img src="imag/frases/sed.png" class="card-img" alt="Frases">
            </div>

            <div class="card-info">
                <h3>Frases Cotidianas</h3>
                <p style="font-size:13px; color:#666; margin:10px 0;">
                    Comienza a comunicarte usando frases completas y expresiones.
                </p>

                <a href="M_frases.php" style="text-decoration: none;">
                    <button class="btn" style="background:#ff007a">
                        ▶ Seguir aprendiendo
                    </button>
                </a>
            </div>
        </div>

    </div>
</section>

</main>

</body>
</html>