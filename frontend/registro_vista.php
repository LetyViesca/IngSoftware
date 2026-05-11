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

        <?php if(isset($_GET['error'])): ?>
            <div class='error-msg' style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; border: 1px solid #f87171; text-align: center;">
                <?php 
                    switch($_GET['error']) {
                        case 'correo_duplicado': echo "Este correo ya está registrado. Intenta iniciar sesión."; break;
                        case 'formato_nombre': echo "Usa solo letras en el nombre y apellidos."; break;
                        case 'correo_invalido': echo "El correo no es válido (ejemplo@dominio.com)."; break;
                        case 'contra_corta': echo "La contraseña debe tener al menos 8 caracteres."; break;
                        case 'tecnico': echo "Error en el servidor. Intenta más tarde."; break;
                        default: echo "Ocurrió un error. Revisa tus datos.";
                    }
                ?>
            </div>
        <?php endif; ?>

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

        <div style="margin-top:20px; font-size:13px; color:#888; text-align: center;">
            ¿Ya tienes cuenta? 
            <a href="login.php" style="color:#2cc19c; text-decoration:none; font-weight:bold;">Inicia sesión</a>
        </div>
    </div>
</body>
</html>