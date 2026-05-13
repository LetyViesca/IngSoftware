<?php include("../backend/auth.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Módulos</title>

    <style>
        /* Mantén tus estilos aquí, están muy bien logrados */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #fcfcfc; }
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .main-logo { height: 35px; }
        .nav-menu { list-style: none; display: flex; gap: 15px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; transition: 0.3s; }
        .nav-menu a:hover { color: #8a4fff; }
        .user-box { display: flex; align-items: center; gap: 15px; }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }
        .user-icon { background: #ff007a; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; }
        .learning-guide { padding: 30px 5%; }
        .card-grid { display: flex; flex-direction: column; gap: 20px; max-width: 800px; margin: 0 auto; }
        .module-card { background: white; border-radius: 20px; overflow: hidden; border: 1px solid #eee; display: flex; gap: 20px; align-items: center; padding: 15px; transition: 0.25s; }
        .module-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .img-container { width: 120px; height: 120px; background: #eee; border-radius: 15px; overflow: hidden; flex-shrink: 0; }
        .card-img { width: 100%; height: 100%; object-fit: cover; }
        .card-info { flex: 1; }
        .card-info h3 { margin-bottom: 8px; color: #333; }
        .btn { margin-top: 10px; border: none; padding: 10px 20px; border-radius: 10px; color: white; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        @media (max-width: 600px) { .module-card { flex-direction: column; text-align: center; } .img-container { width: 100%; height: 150px; } }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size: 13px; font-weight: bold;">Cerrar sesión</a>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<section class="learning-guide">
    <div class="card-grid">

        <div class="module-card">
            <div class="img-container">
                <img src="imag/abecedario/a.png" class="card-img" alt="Abecedario">
            </div>
            <div class="card-info">
                <h3>Abecedario LSM</h3>
                <p style="font-size:13px; color:#666;">Aprende las letras para comunicarte desde lo básico.</p>
                <a href="m_abecedario.php" class="btn" style="background:#8a4fff">▶ Entrar al módulo</a>
            </div>
        </div>

        <div class="module-card">
            <div class="img-container">
                <img src="imag/palabras/uno.png" class="card-img" alt="Palabras Clave">
            </div>
            <div class="card-info">
                <h3>Palabras Clave</h3>
                <p style="font-size:13px; color:#666;">Aprende palabras comunes para el día a día.</p>
                <a href="m_palabras.php" class="btn" style="background:#00c2a8">▶ Entrar al módulo</a>
            </div>
        </div>

        <div class="module-card">
            <div class="img-container">
                <img src="imag/frases/sed.png" class="card-img" alt="Frases Comunes">
            </div>
            <div class="card-info">
                <h3>Frases Comunes</h3>
                <p style="font-size:13px; color:#666;">Aprende a comunicarte con frases completas.</p>
                <a href="m_frases.php" class="btn" style="background:#ff007a">▶ Entrar al módulo</a>
            </div>
        </div>

    </div>
</section>

</body>
</html>