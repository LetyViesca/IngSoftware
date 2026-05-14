<?php
// 1. IMPORTAR CONEXIÓN (Asegúrate que db.php esté en la misma carpeta backend)
include("db.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Saneamiento de datos
    $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $paterno = mysqli_real_escape_string($conexion, $_POST['paterno']);
    $materno = mysqli_real_escape_string($conexion, $_POST['materno']);
    $correo  = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contra  = mysqli_real_escape_string($conexion, $_POST['contra']);

    // 2. VALIDACIÓN DE FORMATO (Solo letras)
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        
        // Ajustamos la ruta al nuevo nombre: registro.php
        header("Location: ../frontend/registro.php?error=Solo letras en nombres");
        exit();
    } 

    // 3. VALIDAR SI EL CORREO YA EXISTE
    $validar = "SELECT * FROM Usuario WHERE correo = '$correo'";
    $resultado_validar = mysqli_query($conexion, $validar);

    if (mysqli_num_rows($resultado_validar) > 0) {
        header("Location: ../frontend/registro.php?error=El correo ya está registrado");
        exit();
    }

    // 4. INSERCIÓN EN BASE DE DATOS
    $sql = "INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) 
            VALUES ('$nombres', '$paterno', '$materno', '$correo', '$contra')";

    if (mysqli_query($conexion, $sql)) {
        // Registro exitoso -> Redirigimos al login
        header("Location: ../frontend/login.php?registro=exitoso");
        exit();
    } else {
        header("Location: ../frontend/registro.php?error=Error técnico en el servidor");
        exit();
    }
}
?>