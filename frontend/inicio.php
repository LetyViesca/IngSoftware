<?php include("../backend/auth.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA Logo">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Módulos ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="M_abecedario.php">Abecedario</a></li>
                    <li><a href="M_palabras.php">Palabras</a></li>
                    <li><a href="M_frases.php">Frases</a></li>
                </ul>
            </li>
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

<div class="container" style="max-width: 1080px; margin: 0 auto; padding: 20px;">
    
    <div class="introduccion-seccion" style="background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 40px; margin-top: 20px;">
        <h1 style="color: #333; margin-bottom: 15px; font-size: 28px;">Bienvenido a ZIGNA 🌟</h1>
        <p style="color: #666; line-height: 1.6; font-size: 16px; margin-bottom: 15px;">
            Tu plataforma interactiva para el aprendizaje de la <strong>Lengua de Señas Mexicana (LSM)</strong>. Nuestro objetivo es derribar las barreras de comunicación mediante módulos dinámicos diseñados paso a paso para ti.
        </p>
        <h3 style="color: #7e4bff; margin-bottom: 10px;">¿Cómo empezar tu ruta de aprendizaje?</h3>
        <ul style="color: #555; line-height: 1.8; padding-left: 20px; font-size: 15px;">
            <li>📖 <strong>Módulo Abecedario:</strong> Domina la dactilología básica y la estructura de cada letra en LSM.</li>
            <li>💬 <strong>Módulo Palabras:</strong> Explora categorías cotidianas como Saludos, Familia y Números.</li>
            <li>🧠 <strong>Evaluaciones:</strong> Pon a prueba tus conocimientos al final de cada sección para medir tu progreso real.</li>
        </ul>
    </div>

    <h2 style="color: #333; margin-bottom: 20px;">Tus Módulos de Aprendizaje</h2>
    <div class="palabras-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        
        <div class="card-palabra" onclick="window.location.href='M_abecedario.php'">
            <div class="img-palabra-container" style="text-align:center; padding:20px; background:#f9f9f9;">
                <img src="imag/abecedario_banner.png" alt="Abecedario" style="max-width:100%; height:120px; object-fit:contain;">
            </div>
            <div class="info-palabra" style="padding: 15px;">
                <h3>Abecedario</h3>
                <p>Aprende las bases del deletreo manual en LSM.</p>
            </div>
        </div>

        <div class="card-palabra" onclick="window.location.href='M_palabras.php'">
            <div class="img-palabra-container" style="text-align:center; padding:20px; background:#f9f9f9;">
                <img src="imag/palabras_banner.png" alt="Palabras" style="max-width:100%; height:120px; object-fit:contain;">
            </div>
            <div class="info-palabra" style="padding: 15px;">
                <h3>Palabras</h3>
                <p>Aprende señas sobre saludos, números y familia.</p>
            </div>
        </div>

    </div>
</div>

</body>
</html>