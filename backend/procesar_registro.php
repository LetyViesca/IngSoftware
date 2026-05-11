<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = trim($_POST['nombres']);
    $paterno = trim($_POST['paterno']);
    $materno = trim($_POST['materno']);
    $correo  = trim($_POST['correo']);
    $contra  = $_POST['contra'];

    // 1. VALIDACIÓN DE TEXTO
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        header("Location: ../frontend/registro_vista.php?error=formato_nombre");
        exit();
    }

    // 2. VALIDACIÓN DE CORREO
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
    // Nota: Usamos id_usuario porque así lo llamaste en phpMyAdmin
    $stmt_check = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        header("Location: ../frontend/registro_vista.php?error=correo_duplicado");
        exit();
    }

    // 5. CIFRADO Y REGISTRO
    $pass_cifrada = password_hash($contra, PASSWORD_BCRYPT);
    
    // AQUÍ ESTÁ EL CAMBIO CLAVE: Los nombres de las columnas deben ser iguales a tu imagen de phpMyAdmin
    $stmt_insert = $conexion->prepare("INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, correo, contra) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sssss", $nombres, $paterno, $materno, $correo, $pass_cifrada);

    if ($stmt_insert->execute()) {
        // Asegúrate de que el archivo se llame login.php o login_vista.php
        header("Location: ../frontend/login.php?registro=exitoso");
    } else {
        // Si hay error, nos manda aquí. Útil para debugear.
        header("Location: ../frontend/registro_vista.php?error=tecnico");
    }

    $stmt_insert->close();
    $conexion->close();
}
?>