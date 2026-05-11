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
    <div class="card">
        <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        <h2>Bienvenido de nuevo</h2>
        <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Inicia sesión para continuar</p>

        <?php if(isset($_GET['error'])): ?>
            <div class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="../backend/procesar_login.php" method="POST">
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" required placeholder="tu@correo.com">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contra" id="loginPass" required placeholder="Tu contraseña">
                <span class="show-pass" onclick="togglePass()">👁️ Ver</span>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <div class="links">
            ¿No tienes cuenta? <a href="registro_vista.php">Regístrate</a>
        </div>
    </div>
</body>
</html>