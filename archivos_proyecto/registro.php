<?php
// Incluimos la conexión a la base de datos
include("db.php");

$mensaje = "";
$tipo_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Recolección de datos y limpieza básica
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];

    // 2. VALIDACIONES DE REGLAS DE NEGOCIO (RNF)
    if (empty($nombre) || empty($correo) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios.";
        $tipo_error = "error";
    } 
    // Validar que el nombre solo contenga letras (RNF: Validación de registro)
    elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
        $mensaje = "El nombre debe contener solo texto.";
        $tipo_error = "nombre";
    }
    // Validar formato de correo
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El formato del correo no es válido.";
        $tipo_error = "correo";
    }
    // Validar largo de contraseña (mínimo 8 caracteres)
    elseif (strlen($password) < 8) {
        $mensaje = "La contraseña debe tener al menos 8 caracteres.";
        $tipo_error = "password";
    } 
    else {
        // 3. SEGURIDAD: Verificar si el correo ya existe (Consultas Preparadas)
        $stmt_check = $conexion->prepare("SELECT id_usuario FROM Usuarios WHERE correo = ?");
        $stmt_check->bind_param("s", $correo);
        $stmt_check->execute();
        $resultado_check = $stmt_check->get_result();

        if ($resultado_check->num_rows > 0) {
            $mensaje = "Este correo ya está registrado.";
            $tipo_error = "correo";
        } else {
            // 4. SEGURIDAD: Cifrado de contraseña con Bcrypt (RNF-01)
            $password_cifrada = password_hash($password, PASSWORD_BCRYPT);

            // 5. INSERCIÓN SEGURO (Prepared Statements - RNF-02)
            $stmt_insert = $conexion->prepare("INSERT INTO Usuarios (nombre_completo, correo, password) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $nombre, $correo, $password_cifrada);

            if ($stmt_insert->execute()) {
                // Redirección al éxito o login
                header("Location: login.php?registro=exitoso");
                exit();
            } else {
                $mensaje = "Error crítico al registrar. Inténtelo más tarde.";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Registro</title>
    <style>
        /* RNF-03: Diseño Responsive 360px */
        * { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: #f5f7fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .input-group { margin-bottom: 15px; }
        label { display: block; font-size: 14px; margin-bottom: 5px; color: #666; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none; }
        
        /* Manejo de errores visuales */
        .input-error { border: 2px solid #ff4757 !important; background-color: #fff5f5; }
        .msg-alerta { color: #ff4757; font-size: 13px; margin-bottom: 15px; text-align: center; font-weight: bold; }
        
        .btn-submit { width: 100%; background: linear-gradient(90deg, #8a4fff, #ff007a); color: white; border: none; padding: 12px; border-radius: 25px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { opacity: 0.9; }

        @media (max-width: 360px) {
            .card { padding: 20px; }
            h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Crear Cuenta</h2>
    
    <?php if ($mensaje): ?>
        <div class="msg-alerta"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="registro.php" method="POST">
        <div class="input-group">
            <label>Nombre Completo</label>
            <input type="text" name="nombre" placeholder="Ej. Juan Pérez" 
                   class="<?php echo ($tipo_error == 'nombre') ? 'input-error' : ''; ?>"
                   value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>">
        </div>

        <div class="input-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" placeholder="correo@ejemplo.com"
                   class="<?php echo ($tipo_error == 'correo') ? 'input-error' : ''; ?>"
                   value="<?php echo isset($correo) ? htmlspecialchars($correo) : ''; ?>">
        </div>

        <div class="input-group">
            <label>Contraseña (mín. 8 caracteres)</label>
            <input type="password" name="password" placeholder="********"
                   class="<?php echo ($tipo_error == 'password') ? 'input-error' : ''; ?>">
        </div>

        <button type="submit" class="btn-submit">Registrarse</button>
    </form>
    
    <p style="text-align:center; font-size: 13px; margin-top: 15px;">
        ¿Ya tienes cuenta? <a href="login.php" style="color: #ff007a; text-decoration:none;">Inicia sesión</a>
    </p>
</div>

</body>
</html>
