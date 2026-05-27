<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: index.php?page=login");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
?>