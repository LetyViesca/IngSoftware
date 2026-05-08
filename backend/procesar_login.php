<?php
include("db.php"); 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contra = $_POST['contra'];

    $sql = "SELECT id_usuario, nombres, contrasena FROM Usuario WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        if ($contra === $usuario['contrasena']) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombres'];
            
            // Redirigimos al inicio (asumiendo que inicio.php está en la raíz o backend)
            header("Location: inicio.php"); 
            exit();
        } else {
            header("Location: ../frontend/login.php?error=La contraseña es incorrecta");
            exit();
        }
    } else {
        header("Location: ../frontend/login.php?error=Este correo no está registrado");
        exit();
    }
}