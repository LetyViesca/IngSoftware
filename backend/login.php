<?php
// 1. INCLUIR CONEXIÓN Y SESIÓN
include("db.php"); 
session_start(); 

$mensaje_error = "";

// 2. PROCESAR EL FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Corregido: mysqli_real_escape_string para evitar errores fatales y dar seguridad
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contra = $_POST['contra'];

    // CORRECCIÓN: Agregamos 'id_usuario' a la consulta SELECT
    $sql = "SELECT id_usuario, nombres, contrasena FROM Usuario WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        // Verificamos la contraseña (comparación directa según tu tabla de Workbench)
        if ($contra === $usuario['contrasena']) {
            // CORRECCIÓN: Guardamos el ID en la sesión para que las evaluaciones lo reconozcan
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombres'];
            
            // Redirigimos a la página principal de módulos
            header("Location: inicio.php"); 
            exit();
        } else {
            $mensaje_error = "La contraseña es incorrecta.";
        }
    } else {
        $mensaje_error = "Este correo no está registrado en ZIGNA.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh; display: flex; align-items: center; justify-content: center; 
        }
        .card { 
            background: white; padding: 30px 40px; border-radius: 30px; 
            width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center;
        }
        .logo-login { height: 45px; margin-bottom: 15px; }
        h2 { color: #333; margin-bottom: 5px; }
        .form-group { margin-bottom: 15px; text-align: left; position: relative; }
        label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 600; color: #555; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px; outline: none; transition: 0.3s; }
        .btn-login { 
            width: 100%; background: #8a4fff; color: white; border: none; 
            padding: 14px; border-radius: 12px; font-weight: bold; cursor: pointer; margin-top: 10px;
        }
        .links { text-align: center; margin-top: 20px; font-size: 13px; color: #888; }
        .links a { color: #2cc19c; text-decoration: none; font-weight: bold; }
        .error-msg { 
            color: #ff007a; background: #fff0f5; padding: 10px; border-radius: 8px; 
            font-size: 13px; margin-bottom: 15px; border: 1px solid #ff007a; 
        }
        .show-pass { position: absolute; right: 10px; top: 35px; cursor: pointer; color: #8a4fff; font-size: 12px; }
    </style>
</head>
<body>

    <div class="card">
        <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        <h2>Bienvenido de nuevo</h2>
        <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Inicia sesión para continuar</p>

        <?php if($mensaje_error != ""): ?>
            <div class="error-msg"><?php echo $mensaje_error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
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
            ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
        </div>
    </div>

    <script>
        function togglePass() {
            const input = document.getElementById('loginPass');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>