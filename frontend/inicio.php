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
            <h1>Sigue el aprendizaje en <span class="zigna-text">ZIGNA</span></h1>
            <p style="color:#666;">Aprende Lengua de Señas Mexicana de manera interactiva.</p>
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
                    <p>Aprende cada letra para deletrear nombres y palabras comunes.</p>
                    <a href="m_abecedario.php">
                        <button class="btn-card" style="background:#8a4fff">▶ Seguir aprendiendo</button>
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
                    <p>Aprende vocabulario esencial del día a día.</p>
                    <a href="m_palabras.php">
                        <button class="btn-card" style="background:#00c2a8">▶ Seguir aprendiendo</button>
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
                    <p>Comienza a comunicarte usando frases completas.</p>
                    <a href="m_frases.php">
                        <button class="btn-card" style="background:#ff007a">▶ Seguir aprendiendo</button>
                    </a>
                </div>
            </div>

        </div>
    </section>
</main>

</body>
</html>