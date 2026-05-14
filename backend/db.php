<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "zigna";
<<<<<<< HEAD
$port = 3307; // El puerto que activaste para evitar conflictos

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

// Asegura que las tildes y la letra Ñ se guarden y muestren correctamente
mysqli_set_charset($conexion, "utf8");

// Prueba de conexión
if (!$conexion) 
{
=======
<<<<<<< HEAD
$port = 3307; // El puerto que activaste para evitar conflictos

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

// Asegura que las tildes y la letra Ñ se guarden y muestren correctamente
mysqli_set_charset($conexion, "utf8");

// Prueba de conexión
if (!$conexion) 
{
=======
$port = 3307; // El puerto que activamos

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

// Prueba de conexión (puedes borrar esto después de confirmar que funciona)
if (!$conexion) {
>>>>>>> e5799d030976e65e3e95fac0fe0a9d7721ef4cb5
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
    die("Error al conectar: " . mysqli_connect_error());
}
?>