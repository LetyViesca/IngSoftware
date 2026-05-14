<?php
<<<<<<< HEAD
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = trim($_POST['nombres']);
    $paterno = trim($_POST['paterno']);
    $materno = trim($_POST['materno']);
    $correo  = trim($_POST['correo']);
    $contra  = $_POST['contra'];

    // 1. VALIDACIÓN DE TEXTO (Solo letras)
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        header("Location: ../frontend/registro_vista.php?error=formato_nombre");
        exit();
    }

    // 2. VALIDACIÓN DE FORMATO DE CORREO (Mejora solicitada por QA)
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../frontend/registro_vista.php?error=correo_invalido");
        exit();
    }

    // 3. LONGITUD DE CONTRASEÑA
    if (strlen($contra) < 8) {
        header("Location: ../frontend/registro_vista.php?error=contra_corta");
        exit();
    }

    // 4. VERIFICAR SI EL CORREO YA EXISTE
    $stmt_check = $conexion->prepare("SELECT id_usuario FROM Usuario  WHERE correo = ?");
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        header("Location: ../frontend/registro_vista.php?error=correo_duplicado");
        exit();
    }

    // 5. CIFRADO Y REGISTRO
    $pass_cifrada = password_hash($contra, PASSWORD_BCRYPT);
    $stmt_insert = $conexion->prepare("INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sssss", $nombres, $paterno, $materno, $correo, $pass_cifrada);

    if ($stmt_insert->execute()) {
        header("Location: ../frontend/login.php?registro=exitoso");
    } else {
        header("Location: ../frontend/registro_vista.php?error=tecnico");
    }

    $stmt_insert->close();
    $conexion->close();
=======
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
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
}
?>