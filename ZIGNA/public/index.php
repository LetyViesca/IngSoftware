<?php
session_start();

function renderView(string $page): string
{
    $map = [
        'inicio' => __DIR__ . '/../app/views/inicio.php',
        'login' => __DIR__ . '/../app/views/login.php',
        'registro' => __DIR__ . '/../app/views/registro_vista.php',
        'progreso' => __DIR__ . '/../app/views/progreso.php',
        'm_abecedario' => __DIR__ . '/../app/views/M_abecedario.php',
        'm_palabras' => __DIR__ . '/../app/views/M_palabras.php',
        'm_frases' => __DIR__ . '/../app/views/M_frases.php',
        'evaluacion' => __DIR__ . '/../app/views/evaluacion.php',
        'evaluacionFrases' => __DIR__ . '/../app/views/evaluacionFrases.php',
        'evaluacionPalabras' => __DIR__ . '/../app/views/evaluacionPalabras.php',
    ];

    return $map[$page] ?? $map['inicio'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        require_once __DIR__ . '/../app/controllers/procesar_login.php';
        exit;
    }

    if ($action === 'register') {
        require_once __DIR__ . '/../app/controllers/procesar_registro.php';
        exit;
    }

    if ($action === 'guardar_progreso') {
        require_once __DIR__ . '/../app/controllers/g_puntaje.php';
        exit;
    }
}

$page = $_GET['page'] ?? 'inicio';
$viewPath = renderView($page);
require_once $viewPath;
