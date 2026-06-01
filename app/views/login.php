<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/login_script.js" defer></script>
</head>
<body>
    <div class="login-card">
        <div class="login-logo-container">
            <img src="assets/img/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        </div>
        <h2>Bienvenido de nuevo</h2>
        <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Inicia sesión para continuar</p>

<?php
if(isset($_GET['error'])){

    $mensaje = "";

    switch($_GET['error']){

        /* NUEVO CASO: Captura el error específico desde procesar_login.php */
        case 'usuario_no_encontrado':
            $mensaje = "El usuario no se encuentra registrado.";
        break;

        case 'formato_nombre':
            $mensaje = "El nombre y los apellidos solo deben contener letras.";
        break;

        case 'correo_invalido':
            $mensaje = "Ingresa un correo electrónico válido.";
        break;

        case 'correo_duplicado':
            $mensaje = "Ese correo ya está registrado.";
        break;

        case 'contra_corta':
            $mensaje = "La contraseña debe tener mínimo 8 caracteres.";
        break;

        case 'tecnico':
            $mensaje = "Ocurrió un error al registrar la cuenta.";
        break;

        default:
            $mensaje = "Ocurrió un error inesperado.";
    }

    echo "<div class='error-msg'>$mensaje</div>";
}
?>

        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="login">
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
            <a href="index.php?page=registro" style="color:#2cc19c; text-decoration:none; font-weight:bold;">
                Regístrate
            </a>
        </div>
    </div>
</body>
</html>