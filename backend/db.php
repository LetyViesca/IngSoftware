<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "zigna";
$port = 3307; // El puerto que activamos

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

// Prueba de conexión (puedes borrar esto después de confirmar que funciona)
if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}
?>