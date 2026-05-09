<?php
include("db.php"); 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Limpieza de datos (aunque usaremos prepared statements, es buena práctica)
    $correo = trim($_POST['correo']);
    $contra = $_POST['contra'];

    // 2. Uso de Prepared Statements para evitar Inyección SQL
    $sql = "SELECT id_usuario, nombres, contrasena FROM Usuario WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($usuario = mysqli_fetch_assoc($resultado)) {
            
            // 3. Verificación de contraseña
            // Nota: En producción deberías usar password_verify() con hashes, 
            // pero mantenemos la lógica de comparación directa por ahora.
            if ($contra === $usuario['contrasena']) {
                // Seteamos las variables de sesión que usan todas tus vistas
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombres'];
                
                // Redirigimos al inicio en el frontend
                header("Location: ../frontend/inicio.php"); 
                exit();
            } else {
                header("Location: ../frontend/login.php?error=La contraseña es incorrecta");
                exit();
            }
        } else {
            header("Location: ../frontend/login.php?error=Este correo no está registrado");
            exit();
        }
        
        mysqli_stmt_close($stmt);
    } else {
        // Error de preparación de la consulta
        header("Location: ../frontend/login.php?error=Error interno del servidor");
        exit();
    }
}
?>