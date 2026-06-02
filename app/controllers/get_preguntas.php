<?php
// [Sprint 5 - RNF-02] Endpoint que devuelve preguntas aleatorias por módulo
if (session_status() === PHP_SESSION_NONE) session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

require_once __DIR__ . '/../config/db.php';

$id_modulo = 0;
if (isset($_GET['id_Modulo'])) {
    $id_modulo = intval($_GET['id_Modulo']);
} elseif (isset($_POST['id_Modulo'])) {
    $id_modulo = intval($_POST['id_Modulo']);
}

if ($id_modulo <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'id_Modulo inválido']);
    exit();
}

$sql = "SELECT * FROM Pregunta WHERE id_Modulo = $id_modulo ORDER BY RAND() LIMIT 10";
$res = mysqli_query($conexion, $sql);

$preguntas = [];
while ($fila = mysqli_fetch_assoc($res)) {
    $imagen = $fila['imagen'];
    $imagen = str_replace('imag/', 'assets/img/', $imagen);
    $imagen = str_replace('../frontend/imag/', 'assets/img/', $imagen);
    $imagen = str_replace('frontend/imag/', 'assets/img/', $imagen);

    $preguntas[] = [
        'id_pregunta' => (int)$fila['id_pregunta'],
        'imagen' => $imagen,
        'respuesta_correcta' => $fila['respuesta_correcta'],
        'opcion1' => $fila['opcion1'],
        'opcion2' => $fila['opcion2'],
        'opcion3' => $fila['opcion3']
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($preguntas);

?>
