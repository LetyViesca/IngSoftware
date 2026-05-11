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
            <div class="error-msg" style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; border: 1px solid #f87171; text-align: center;">
                <?php 
                    if($_GET['error'] == 'credenciales_invalidas') {
                        echo "El correo o la contraseña son incorrectos. Por favor, verifica tus datos.";
                    } else {
                        echo "Ocurrió un error inesperado. Intenta de nuevo.";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="../backend/procesar_login.php" method="POST">
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" required placeholder="tu@correo.com">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contra" id="loginPass" required placeholder="Tu contraseña">
                <span class="show-pass" onclick="togglePass()" style="cursor:pointer; font-size: 12px; color: #2cc19c;">👁️ Ver</span>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <div class="links" style="margin-top: 20px; font-size: 13px; text-align: center;">
            ¿No tienes cuenta? <a href="registro_vista.php" style="color: #2cc19c; text-decoration: none; font-weight: bold;">Regístrate</a>
        </div>
    </div>
</body>
</html>