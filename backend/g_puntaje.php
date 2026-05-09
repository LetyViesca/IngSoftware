<?php

include("db.php");

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {

    echo json_encode([
        "status" => "error",
        "message" => "No se encontró el ID de usuario"
    ]);

    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuario = $_SESSION['id_usuario'];

    $nombre_modulo = $_POST['modulo'];

    $puntaje = intval($_POST['puntaje']);

    /* ===== MAPEO DE MÓDULOS ===== */

    $id_modulo = 2;

    if (
        $nombre_modulo == 'Abecedario' ||
        $nombre_modulo == 'Abecedario LSM'
    ) {

        $id_modulo = 1;
    }

    if ($nombre_modulo == 'Frases') {

        $id_modulo = 3;
    }

    /* ===== DATOS ===== */

    $estado =
    ($puntaje >= 70)
    ? 'Completado'
    : 'En progreso';

    $lecciones =
    ($puntaje >= 70)
    ? 1
    : 0;

    $fecha = date("Y-m-d");

    /* ===== VERIFICAR SI YA EXISTE ===== */

    $sql_verificar =
    "SELECT * FROM Progreso
     WHERE id_Usuario = '$id_usuario'
     AND id_Modulo = '$id_modulo'";

    $resultado_verificar =
    mysqli_query($conexion, $sql_verificar);

    /* ===== UPDATE ===== */

    if (mysqli_num_rows($resultado_verificar) > 0) {

        $sql =
        "UPDATE Progreso
         SET
         fecha_ultimo_acceso = '$fecha',
         lecciones_completadas = '$lecciones',
         estado = '$estado'
         WHERE id_Usuario = '$id_usuario'
         AND id_Modulo = '$id_modulo'";

    } else {

        /* ===== INSERT ===== */

        $sql =
        "INSERT INTO Progreso
        (
            fecha_ultimo_acceso,
            lecciones_completadas,
            estado,
            id_Usuario,
            id_Modulo
        )
        VALUES
        (
            '$fecha',
            '$lecciones',
            '$estado',
            '$id_usuario',
            '$id_modulo'
        )";
    }

    /* ===== EJECUTAR ===== */

    if (mysqli_query($conexion, $sql)) {

        echo json_encode([
            "status" => "success",
            "estado" => $estado
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => mysqli_error($conexion)
        ]);
    }
}
?>