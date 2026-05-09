<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
session_start();

// Si el usuario no tiene una sesión activa, lo redirigimos al login
// Nota: login.php ahora debe estar en la misma carpeta (frontend)
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
    <link rel="stylesheet" href="styles.css">
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
                        <button class="btn-card" style="background:#8a4fff">
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
                        <button class="btn-card" style="background:#00c2a8">
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
                        <button class="btn-card" style="background:#ff007a">
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