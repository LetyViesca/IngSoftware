<?php
include("db.php");
session_start();

header('Content-Type: application/json');

<<<<<<< HEAD
// 1. Verificación de sesión
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Sesión no válida"
    ]);
    exit();
=======
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["status" => "error", "message" => "No se encontró el ID de usuario"]);
    exit;
>>>>>>> e5799d030976e65e3e95fac0fe0a9d7721ef4cb5
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
<<<<<<< HEAD
    $nombre_modulo = $_POST['modulo'] ?? '';
    $puntaje = isset($_POST['puntaje']) ? intval($_POST['puntaje']) : 0;

    /* ===== MAPEO DE MÓDULOS ===== */
    // Por defecto es Palabras (id 2)
    $id_modulo = 2; 

    if (strpos($nombre_modulo, 'Abecedario') !== false) {
        $id_modulo = 1;
    } elseif (strpos($nombre_modulo, 'Frases') !== false) {
        $id_modulo = 3;
    }

    /* ===== LÓGICA DE NEGOCIO ===== */
    $estado = ($puntaje >= 70) ? 'Completado' : 'En progreso';
    $lecciones = ($puntaje >= 70) ? 1 : 0;
    $fecha = date("Y-m-d");

    /* ===== USO DE PREPARED STATEMENTS (Seguridad Crítica) ===== */
    // Verificamos si ya existe registro para actualizar o insertar
    $sql_verificar = "SELECT id_progreso FROM Progreso WHERE id_Usuario = ? AND id_Modulo = ?";
    $stmt_v = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt_v, "ii", $id_usuario, $id_modulo);
    mysqli_stmt_execute($stmt_v);
    $res_v = mysqli_stmt_get_result($stmt_v);

    if (mysqli_num_rows($res_v) > 0) {
        // UPDATE: Si ya existe, actualizamos progreso
        $sql = "UPDATE Progreso SET fecha_ultimo_acceso = ?, lecciones_completadas = ?, estado = ? 
                WHERE id_Usuario = ? AND id_Modulo = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sisii", $fecha, $lecciones, $estado, $id_usuario, $id_modulo);
    } else {
        // INSERT: Si es la primera vez que lo hace
        $sql = "INSERT INTO Progreso (fecha_ultimo_acceso, lecciones_completadas, estado, id_Usuario, id_Modulo) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sisii", $fecha, $lecciones, $estado, $id_usuario, $id_modulo);
    }

    /* ===== EJECUCIÓN FINAL ===== */
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode([
            "status" => "success",
            "estado" => $estado,
            "puntuacion_registrada" => $puntaje
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error al guardar en BD"
        ]);
    }
    
    mysqli_stmt_close($stmt);
=======
    $nombre_modulo = $_POST['modulo']; 
    $puntaje = intval($_POST['puntaje']);
    
    // Mapeo según tus IDs de la tabla Modulo
    // Asegúrate de que en tu BD el ID del Abecedario sea 1, Palabras 2, etc.
    $id_modulo = 2; 
    if($nombre_modulo == 'Abecedario') $id_modulo = 1;
    if($nombre_modulo == 'Frases') $id_modulo = 3;

    $estado = ($puntaje >= 70) ? 'Completado' : 'En curso';
    $lecciones = ($puntaje >= 70) ? 1 : 0; 
    $fecha = date("Y-m-d");

    // Query ajustada a tus columnas (RF-08)
    $sql = "INSERT INTO Progreso (fecha_ultimo_acceso, lecciones_completadas, estado, id_Usuario, id_Modulo) 
            VALUES ('$fecha', '$lecciones', '$estado', '$id_usuario', '$id_modulo')
            ON DUPLICATE KEY UPDATE 
            fecha_ultimo_acceso = '$fecha',
            estado = '$estado',
            lecciones_completadas = '$lecciones'";

    if (mysqli_query($conexion, $sql)) {
        echo json_encode(["status" => "success", "estado" => $estado]);
    } else {
        // Esto nos dirá si falta alguna columna o hay error de FK
        echo json_encode(["status" => "error", "message" => mysqli_error($conexion)]);
    }
>>>>>>> e5799d030976e65e3e95fac0fe0a9d7721ef4cb5
}
?>