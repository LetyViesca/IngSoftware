<?php 
// 1. CENTRALIZACIÓN DE SEGURIDAD
include("../backend/auth.php"); 
?>
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
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
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
            <span class="user-name">Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size:13px; font-weight: bold;">Cerrar sesión</a>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<div class="container" style="max-width: 1080px; margin: 0 auto; padding: 20px;">
    
    <h2 style="color: #333; margin-bottom: 20px; margin-top: 20px;">Tus Módulos de Aprendizaje</h2>
    
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