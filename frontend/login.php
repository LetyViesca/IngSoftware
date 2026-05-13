<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/login_script.js" defer></script>
</head>
<body>
    <div class="login-card">
        <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        <h2>Bienvenido de nuevo</h2>
        <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Inicia sesión para continuar</p>

        <?php if(isset($_GET['error'])): ?>
            <div class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="../backend/procesar_login.php" method="POST">
            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" required placeholder="tu@correo.com">
            </div>
            
            <div class="input-group" style="position: relative;">
                <label>Contraseña</label>
                <input type="password" name="contra" id="loginPass" required placeholder="Tu contraseña">
                <span class="show-pass" onclick="togglePass()" style="position: absolute; right: 10px; bottom: 10px; cursor: pointer; font-size: 12px; color: #2cc19c;">👁️ Ver</span>
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <div style="margin-top:20px; font-size:13px; color:#888;">
            ¿No tienes cuenta? 
            <a href="registro_vista.php" style="color:#2cc19c; text-decoration:none; font-weight:bold;">
                Regístrate
            </a>
        </div>
    </div>
</body>
</html>