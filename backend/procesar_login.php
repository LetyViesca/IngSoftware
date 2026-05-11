<?php
include("db.php"); 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $contra = $_POST['contra'];

    // CAMBIO 1: Nombre de tabla a 'usuarios' (como en tu imagen)
    // CAMBIO 2: Nombre de columna a 'contra' (como en tu imagen)
    $sql = "SELECT id_usuario, nombres, contra FROM usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($usuario = mysqli_fetch_assoc($resultado)) {
            
            // CAMBIO 3: Aquí también usamos 'contra'
            if (password_verify($contra, $usuario['contra'])) {
                
                session_regenerate_id();
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombres'];
                
                header("Location: ../frontend/inicio.php"); 
                exit();
            } else {
                header("Location: ../frontend/login.php?error=credenciales_invalidas");
                exit();
            }
        } else {
            header("Location: ../frontend/login.php?error=credenciales_invalidas");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../frontend/login.php?error=error_interno");
        exit();
    }
}
$conexion->close();
?>