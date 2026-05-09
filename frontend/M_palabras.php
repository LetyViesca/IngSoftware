<?php
// 1. CONTROL DE SESIÓN Y SEGURIDAD
session_start();

// Validamos que el usuario esté autenticado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Palabras LSM</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
    <nav>

        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png"
                 class="main-logo"
                 alt="ZIGNA">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">

            <span class="user-name">
                Hola,
                <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>

            <a href="login.php"
               style="text-decoration:none; color:#666; font-size:13px;">
               Cerrar sesión
            </a>

            <div class="user-icon">👤</div>

        </div>
    </nav>
</header>

<div class="palabras-container">
    <h1 class="palabras-titulo">
         Módulo: Palabras LSM
    </h1>

<?php
include("../backend/db.php");
?>
<!-- ===== SALUDOS ===== -->

<h2 class="palabras-subtitulo">Saludos</h2>

<?php
$querySaludos = "
SELECT * FROM Contenido
WHERE id_Modulo = 2
LIMIT 6
";

$resultadoSaludos =
mysqli_query($conexion, $querySaludos);
?>

<div class="palabras-grid">

<?php while($fila = mysqli_fetch_assoc($resultadoSaludos)) { ?>

    <div class="palabras-card">

        <div class="palabras-img-container">
            <img src="<?php echo $fila['imagen']; ?>">
        </div>

        <div class="palabras-info">

            <h3>
                <?php echo $fila['titulo']; ?>
            </h3>

            <p>
                <?php echo $fila['descripcion']; ?>
            </p>

        </div>

    </div>

<?php } ?>

</div>

<!-- ===== FAMILIA ===== -->

<h2 class="palabras-subtitulo">Familia</h2>

<?php
$queryFamilia = "
SELECT * FROM Contenido
WHERE id_Modulo = 2
LIMIT 6 OFFSET 6
";

$resultadoFamilia =
mysqli_query($conexion, $queryFamilia);
?>

<div class="palabras-grid">

<?php while($fila = mysqli_fetch_assoc($resultadoFamilia)) { ?>

    <div class="palabras-card">

        <div class="palabras-img-container">
            <img src="<?php echo $fila['imagen']; ?>">
        </div>

        <div class="palabras-info">

            <h3>
                <?php echo $fila['titulo']; ?>
            </h3>

            <p>
                <?php echo $fila['descripcion']; ?>
            </p>

        </div>

    </div>

<?php } ?>

</div>

<!-- ===== NÚMEROS ===== -->

<h2 class="palabras-subtitulo">Números</h2>

<?php
$queryNumeros = "
SELECT * FROM Contenido
WHERE id_Modulo = 2
LIMIT 6 OFFSET 12
";

$resultadoNumeros =
mysqli_query($conexion, $queryNumeros);
?>

<div class="palabras-grid">

<?php while($fila = mysqli_fetch_assoc($resultadoNumeros)) { ?>

    <div class="palabras-card">

        <div class="palabras-img-container">
            <img src="<?php echo $fila['imagen']; ?>">
        </div>

        <div class="palabras-info">

            <h3>
                <?php echo $fila['titulo']; ?>
            </h3>

            <p>
                <?php echo $fila['descripcion']; ?>
            </p>

        </div>

    </div>

<?php } ?>

</div>

</div>

<div class="palabras-btn-container">

    <a href="evaluacionPalabras.php"
       class="palabras-btn">

       Comenzar Evaluación ✨

    </a>

</div>

</div>

</body>
</html>