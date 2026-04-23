<?php
// 1. INCLUIR LA CONEXIÓN
include("db.php"); 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $paterno = mysqli_real_escape_string($conexion, $_POST['paterno']);
    $materno = mysqli_real_escape_string($conexion, $_POST['materno']);
    $correo  = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contra  = mysqli_real_escape_string($conexion, $_POST['contra']);

    // --- NUEVA VALIDACIÓN: Solo letras y espacios ---
    // La expresión /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/ permite letras (incluyendo acentos y ñ) y espacios.
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        
        $mensaje = "Error: Los nombres y apellidos solo pueden contener letras.";
    } else {
        // VALIDACIÓN DE CORREO DUPLICADO
        $validar = "SELECT * FROM Usuario WHERE correo = '$correo'";
        $resultado_validar = mysqli_query($conexion, $validar);

        if (mysqli_num_rows($resultado_validar) > 0) {
            $mensaje = "Error: El correo '$correo' ya está registrado.";
        } else {
            // INSERCIÓN SI TODO ES CORRECTO
            $sql = "INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) 
                    VALUES ('$nombres', '$paterno', '$materno', '$correo', '$contra')";

            if (mysqli_query($conexion, $sql)) {
                header("Location: login.php?registro=exitoso");
                exit();
            } else {
                $mensaje = "Error al registrar: " . mysqli_error($conexion);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ZIGNA - Registro</title>
    <style>
        /* Tus estilos se mantienen iguales... */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            height: 100vh; display: flex; align-items: center; justify-content: center; 
        }
        .login-card {
            background: white; padding: 30px 40px; border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center;
        }
        .logo-login { height: 45px; margin-bottom: 15px; }
        .input-group { text-align: left; margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 600; color: #555; }
        input {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px; outline: none;
        }
        .btn-login {
            width: 100%; background: #8a4fff; color: white; border: none;
            padding: 14px; border-radius: 12px; font-weight: bold; cursor: pointer;
        }
        .error-msg { background-color: #fff5f5; color: #ff007a; padding: 10px; border-radius: 8px; border: 1px solid #ff007a; margin-bottom: 15px; font-size: 13px; }
    </style>
</head>
<body>

    <div class="login-card">
        <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login">
        <h2>Crea tu cuenta</h2>

        <?php if($mensaje != "") echo "<div class='error-msg'>$mensaje</div>"; ?>

        <form action="registro.php" method="POST">
            
            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="nombres" placeholder="Tu nombre" 
                       pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" required>
            </div>

            <div class="input-group">
                <label>Apellido Paterno</label>
                <input type="text" name="paterno" placeholder="Apellido paterno" 
                       pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" required>
            </div>

            <div class="input-group">
                <label>Apellido Materno</label>
                <input type="text" name="materno" placeholder="Apellido materno" 
                       pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" required>
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
            ¿Ya tienes cuenta? <a href="login.php" style="color:#2cc19c; text-decoration:none; font-weight:bold;">Inicia sesión</a>
        </div>
    </div>

</body>
</html>