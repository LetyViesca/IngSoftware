<?php
require_once __DIR__ . "/../config/db.php";
session_start();

header('Content-Type: application/json');

// 1. Verificación de sesión
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Sesión no válida"
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
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
        // [Sprint 5 - Progreso Mejorado] Guardar en Resultado_evaluacion
        // Obtener id_Evaluacion del módulo
        $sql_eval = "SELECT id_Evaluacion FROM Evaluacion WHERE id_Modulo = ?";
        $stmt_eval = mysqli_prepare($conexion, $sql_eval);
        mysqli_stmt_bind_param($stmt_eval, "i", $id_modulo);
        mysqli_stmt_execute($stmt_eval);
        $res_eval = mysqli_stmt_get_result($stmt_eval);
        
        if ($res_eval && mysqli_num_rows($res_eval) > 0) {
            $row_eval = mysqli_fetch_assoc($res_eval);
            $id_evaluacion = $row_eval['id_Evaluacion'];
            
            // Verificar si ya existe registro en Resultado_evaluacion (UNIQUE constraint)
            $sql_check_res = "SELECT idResultado_evaluacion FROM Resultado_evaluacion WHERE id_Usuario = ? AND id_Evaluacion = ?";
            $stmt_check_res = mysqli_prepare($conexion, $sql_check_res);
            mysqli_stmt_bind_param($stmt_check_res, "ii", $id_usuario, $id_evaluacion);
            mysqli_stmt_execute($stmt_check_res);
            $res_check = mysqli_stmt_get_result($stmt_check_res);
            
            $fecha_ahora = date("Y-m-d H:i:s");
            
            if (mysqli_num_rows($res_check) > 0) {
                // UPDATE Resultado_evaluacion (sobrescribir último intento)
                $sql_update_res = "UPDATE Resultado_evaluacion SET puntaje = ?, fecha = ? WHERE id_Usuario = ? AND id_Evaluacion = ?";
                $stmt_update_res = mysqli_prepare($conexion, $sql_update_res);
                mysqli_stmt_bind_param($stmt_update_res, "isii", $puntaje, $fecha_ahora, $id_usuario, $id_evaluacion);
                mysqli_stmt_execute($stmt_update_res);
                mysqli_stmt_close($stmt_update_res);
            } else {
                // INSERT Resultado_evaluacion
                $sql_insert_res = "INSERT INTO Resultado_evaluacion (fecha, puntaje, id_Usuario, id_Evaluacion) VALUES (?, ?, ?, ?)";
                $stmt_insert_res = mysqli_prepare($conexion, $sql_insert_res);
                mysqli_stmt_bind_param($stmt_insert_res, "siii", $fecha_ahora, $puntaje, $id_usuario, $id_evaluacion);
                mysqli_stmt_execute($stmt_insert_res);
                mysqli_stmt_close($stmt_insert_res);
            }
            
            // INSERT Historial_evaluacion (siempre guardar para tener historial completo)
            $sql_insert_hist = "INSERT INTO Historial_evaluacion (id_Usuario, id_Evaluacion, puntaje, fecha) VALUES (?, ?, ?, ?)";
            $stmt_insert_hist = mysqli_prepare($conexion, $sql_insert_hist);
            mysqli_stmt_bind_param($stmt_insert_hist, "iiis", $id_usuario, $id_evaluacion, $puntaje, $fecha_ahora);
            mysqli_stmt_execute($stmt_insert_hist);
            mysqli_stmt_close($stmt_insert_hist);
            
            mysqli_stmt_close($stmt_check_res);
        }
        
        mysqli_stmt_close($stmt_eval);
        
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
}
?>