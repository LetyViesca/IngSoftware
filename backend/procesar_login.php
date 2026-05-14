<?php
<<<<<<< HEAD
/**
 * ARCHIVO: backend/procesar_login.php
 * REFACTORIZACIÓN: Verificación Bcrypt + Manejo de Errores Limpios
 */

=======
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
include("db.php"); 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    // 1. Limpieza y recepción de datos
    $correo = trim($_POST['correo']);
    $contra = $_POST['contra'];

    // 2. Uso de Prepared Statements (Checklist Punto 2)
=======
    // 1. Limpieza de datos (aunque usaremos prepared statements, es buena práctica)
    $correo = trim($_POST['correo']);
    $contra = $_POST['contra'];

    // 2. Uso de Prepared Statements para evitar Inyección SQL
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
    $sql = "SELECT id_usuario, nombres, contrasena FROM Usuario WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($usuario = mysqli_fetch_assoc($resultado)) {
            
<<<<<<< HEAD
            // 3. VERIFICACIÓN DE CONTRASEÑA CON BCRYPT (Checklist Punto 1)
            // Reemplazamos el === por password_verify para validar el hash
            if (password_verify($contra, $usuario['contrasena'])) {
                
                // Regenerar el ID de sesión por seguridad (Buena práctica adicional)
                session_regenerate_id();

                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombres'];
                
                // Redirigimos al inicio en la nueva ruta del frontend
                header("Location: ../frontend/inicio.php"); 
                exit();
            } else {
                // Mensaje genérico para no dar pistas a atacantes
                header("Location: ../frontend/login.php?error=credenciales_invalidas");
                exit();
            }
        } else {
            header("Location: ../frontend/login.php?error=credenciales_invalidas");
=======
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
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
            exit();
        }
        
        mysqli_stmt_close($stmt);
    } else {
<<<<<<< HEAD
        // Error técnico oculto al usuario final (Checklist Punto 5)
        header("Location: ../frontend/login.php?error=error_interno");
        exit();
    }
}
$conexion->close();
=======
        // Error de preparación de la consulta
        header("Location: ../frontend/login.php?error=Error interno del servidor");
        exit();
    }
}
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
?>