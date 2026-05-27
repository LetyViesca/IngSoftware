<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario inició sesión
if (!isset($_SESSION['id_usuario'])) {

    header("Location: index.php?page=login");
    exit();
}

// Datos del usuario disponibles globalmente
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];