<?php
require_once __DIR__ . "/../config/db.php";

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
        header("Location: index.php?page=registro&error=formato_nombre");
        exit();
    }

    // 2. VALIDACIÓN DE FORMATO DE CORREO (Mejora solicitada por QA)
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?page=registro&error=correo_invalido");
        exit();
    }

    // 3. LONGITUD DE CONTRASEÑA
    if (strlen($contra) < 8) {
        header("Location: index.php?page=registro&error=contra_corta");
        exit();
    }

    // 4. VERIFICAR SI EL CORREO YA EXISTE
    $stmt_check = $conexion->prepare("SELECT id_usuario FROM Usuario WHERE correo = ?");
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        header("Location: index.php?page=registro&error=correo_duplicado");
        exit();
    }

    // 5. CIFRADO Y REGISTRO
    // Modificado para retornar a registro_vista.php con status=exito
    $pass_cifrada = password_hash($contra, PASSWORD_BCRYPT);
    $stmt_insert = $conexion->prepare("INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sssss", $nombres, $paterno, $materno, $correo, $pass_cifrada);

    if ($stmt_insert->execute()) {
        // Redirige de vuelta a la vista de registro para que JS controle los 3 segundos de espera con el aviso verde
        header("Location: index.php?page=registro&status=exito");
    } else {
        header("Location: index.php?page=registro&error=tecnico");
    }

    $stmt_insert->close();
    $conexion->close();
}
?>