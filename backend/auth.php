<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
?>