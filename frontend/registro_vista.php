<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = trim($_POST['nombres']);
    $paterno = trim($_POST['paterno']);
    $materno = trim($_POST['materno']);
    $correo  = trim($_POST['correo']);
    $contra  = $_POST['contra'];

<<<<<<< HEAD
    // 1. VALIDACIÓN DE TEXTO (Solo letras)
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        header("Location: ../frontend/registro_vista.php?error=formato_nombre");
        exit();
    }
=======
        <?php
if(isset($_GET['error'])){

    $mensaje = "";

    switch($_GET['error']){

        case 'formato_nombre':
            $mensaje = "El nombre y los apellidos solo deben contener letras.";
        break;

        case 'correo_invalido':
            $mensaje = "Ingresa un correo electrónico válido.";
        break;

        case 'correo_duplicado':
            $mensaje = "Ese correo ya está registrado.";
        break;

        case 'contra_corta':
            $mensaje = "La contraseña debe tener mínimo 8 caracteres.";
        break;

        case 'tecnico':
            $mensaje = "Ocurrió un error al registrar la cuenta.";
        break;

        default:
            $mensaje = "Ocurrió un error inesperado.";
    }

    echo "<div class='error-msg'>$mensaje</div>";
}
?>
>>>>>>> desarrollo

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
}
?>