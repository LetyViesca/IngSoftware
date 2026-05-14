<?php
// 1. INICIO DE SESIÓN Y CONEXIÓN
session_start();
include("db.php");

$mensaje = "";
$tipo_error = "";

// Si ya tiene sesión, mandarlo al inicio
if (isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];

    // 2. VALIDACIÓN: Campos no vacíos
    if (empty($correo) || empty($password)) {
        $mensaje = "Por favor, llena todos los campos.";
        $tipo_error = "general";
    } 
    else {
        // 3. SEGURIDAD: Consulta Preparada (RNF-02)
        $stmt = $conexion->prepare("SELECT id_usuario, nombre_completo, password FROM Usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // 4. SEGURIDAD: Verificar contraseña cifrada (RNF-01)
            if (password_verify($password, $usuario['password'])) {
                // Credenciales correctas: Crear variables de sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_completo'];

                header("Location: inicio.php");
                exit();
            } else {
                $mensaje = "Contraseña incorrecta.";
                $tipo_error = "password";
            }
        } else {
            $mensaje = "El correo no está registrado.";
            $tipo_error = "correo";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Iniciar Sesión</title>
    <style>
        /* RNF-03: Diseño Responsive 360px - 1920px */
        * { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { 
            background: #f5f7fa; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            padding: 20px;
        }
        .login-card { 
            background: white; 
            padding: 40px 30px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 400px; 
        }
        .logo-container { text-align: center; margin-bottom: 25px; }
        .logo-container img { height: 50px; }
        
        h2 { text-align: center; color: #333; margin-bottom: 25px; font-size: 1.5rem; }
        
        .input-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; margin-bottom: 8px; color: #555; font-weight: 600; }
        input { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            outline: none; 
            transition: 0.3s;
        }
        input:focus { border-color: #8a4fff; box-shadow: 0 0 8px rgba(138, 79, 255, 0.2); }

        /* Estilos de Error */
        .input-error { border: 2px solid #ff4757 !important; background-color: #fff5f5; }
        .error-msg { color: #ff4757; font-size: 13px; text-align: center; margin-bottom: 20px; font-weight: bold; }

        .btn-login { 
            width: 100%; 
            background: linear-gradient(90deg, #8a4fff, #ff007a); 
            color: white; 
            border: none; 
            padding: 14px; 
            border-radius: 30px; 
            font-weight: bold; 
            font-size: 16px;
            cursor: pointer; 
            transition: 0.4s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 0, 122, 0.3); }

        .footer-links { text-align: center; margin-top: 25px; font-size: 14px; color: #777; }
        .footer-links a { color: #ff007a; text-decoration: none; font-weight: bold; }

        /* Ajuste para pantallas muy pequeñas (360px) */
        @media (max-width: 360px) {
            .login-card { padding: 30px 20px; }
            h2 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="logo-container">
        <img src="imag/Logo_Zigna.png" alt="Zigna Logo">
    </div>

    <h2>Bienvenido de nuevo</h2>

    <?php if ($mensaje): ?>
        <div class="error-msg"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="input-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" placeholder="tu@correo.com" required
                   class="<?php echo ($tipo_error == 'correo' || $tipo_error == 'general') ? 'input-error' : ''; ?>"
                   value="<?php echo isset($correo) ? htmlspecialchars($correo) : ''; ?>">
        </div>

        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••" required
                   class="<?php echo ($tipo_error == 'password' || $tipo_error == 'general') ? 'input-error' : ''; ?>">
        </div>

        <button type="submit" class="btn-login">Ingresar</button>
    </form>

    <div class="footer-links">
        ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
    </div>
</div>

</body>
</html>
