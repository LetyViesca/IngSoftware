<?php
/**
 * ARCHIVO: backend/procesar_registro.php
 * REFACTORIZACIÓN PROFESIONAL: Bcrypt + Prepared Statements
 */

include("db.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilación de datos (Ya no usamos mysqli_real_escape_string porque usaremos Prepared Statements)
    $nombres = trim($_POST['nombres']);
    $paterno = trim($_POST['paterno']);
    $materno = trim($_POST['materno']);
    $correo  = trim($_POST['correo']);
    $contra  = $_POST['contra'];

    // 1. VALIDACIÓN DE REGISTRO (Checklist Punto 3)
    // Solo letras y espacios
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombres) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $paterno) || 
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $materno)) {
        header("Location: ../frontend/registro_vista.php?error=formato_nombre");
        exit();
    } 

    // Validación de longitud de contraseña (Checklist Punto 3)
    if (strlen($contra) < 8) {
        header("Location: ../frontend/registro_vista.php?error=contra_corta");
        exit();
    }

    // 2. VALIDAR SI EL CORREO EXISTE (Usando Prepared Statements - Checklist Punto 2)
    $stmt_check = $conexion->prepare("SELECT id_usuario FROM Usuario WHERE correo = ?");
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: ../frontend/registro_vista.php?error=correo_duplicado");
        exit();
    }
    $stmt_check->close();

    // 3. CIFRADO DE CONTRASEÑA CON BCRYPT (Checklist Punto 1)
    $contra_segura = password_hash($contra, PASSWORD_BCRYPT);

    // 4. INSERCIÓN SEGURA (Checklist Punto 2)
    // Usamos "?" para evitar Inyección SQL
    $sql = "INSERT INTO Usuario (nombres, apellido_paterno, apellido_materno, correo, contrasena) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt_insert = $conexion->prepare($sql);
    $stmt_insert->bind_param("sssss", $nombres, $paterno, $materno, $correo, $contra_segura);

    if ($stmt_insert->execute()) {
        // Registro exitoso
        header("Location: ../frontend/login.php?registro=exitoso");
        exit();
    } else {
        // Manejo de errores sin mostrar datos internos de MySQL (Checklist Punto 5)
        header("Location: ../frontend/registro_vista.php?error=tecnico");
        exit();
    }
    $stmt_insert->close();
}
$conexion->close();
?>