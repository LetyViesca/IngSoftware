<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "zigna";
$port = 3307; // El puerto que activaste para evitar conflictos

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

// Asegura que las tildes y la letra Ñ se guarden y muestren correctamente
mysqli_set_charset($conexion, "utf8");

// Prueba de conexión
if (!$conexion) 
{
    die("Error al conectar: " . mysqli_connect_error());
}
?>