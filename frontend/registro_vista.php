<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="login-card">
        <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        <h2>Crea tu cuenta</h2>

        <?php
if(isset($_GET['error'])){

    $mensaje = "";

    switch($_GET['error']){

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

        <form action="../backend/procesar_registro.php" method="POST">
            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="nombres" placeholder="Tu nombre" required>
            </div>
            
            <div class="input-group">
                <label>Apellido Paterno</label>
                <input type="text" name="paterno" placeholder="Apellido paterno" required>
            </div>
            
            <div class="input-group">
                <label>Apellido Materno</label>
                <input type="text" name="materno" placeholder="Apellido materno" required>
            </div>
            
            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
            </div>
            
            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="contra" placeholder="Mínimo 8 caracteres" minlength="8" required>
            </div>
            
            <button type="submit" class="btn-login">Crear Cuenta</button>
        </form>

        <div style="margin-top:20px; font-size:13px; color:#888;">
            ¿Ya tienes cuenta? 
            <a href="login.php" style="color:#2cc19c; text-decoration:none; font-weight:bold;">
                Inicia sesión
            </a>
        </div>
    </div>
</body>
</html>