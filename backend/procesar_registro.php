<?php
include("db.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $paterno = mysqli_real_escape_string($conexion, $_POST['paterno']);
    $materno = mysqli_real_escape_string($conexion, $_POST['materno']);
    $correo  = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contra  = mysqli_real_escape_string($conexion, $_POST['contra']);

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        
        header("Location: ../frontend/registro_vista.php?error=Solo letras en nombres");
        exit();
    } else {
        $validar = "SELECT * FROM Usuario WHERE correo = '$correo'";
        $resultado_validar = mysqli_query($conexion, $validar);

        if (mysqli_num_rows($resultado_validar) > 0) {
            header("Location: ../frontend/registro_vista.php?error=El correo ya está registrado");
            exit();
        } else {
            $sql = "INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) 
                    VALUES ('$nombres', '$paterno', '$materno', '$correo', '$contra')";

            if (mysqli_query($conexion, $sql)) {
                // CORRECCIÓN: Apuntar a la carpeta frontend
                header("Location: ../frontend/login.php?registro=exitoso");
                exit();
            } else {
                header("Location: ../frontend/registro_vista.php?error=Error en el servidor");
                exit();
            }
        }
    }
}
?>