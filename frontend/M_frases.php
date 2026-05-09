<?php
include("../backend/db.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZIGNA - Frases LSM</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>

    <nav>

        <a href="inicio.php">

            <img src="imag/Logo_Zigna.png"
                 class="main-logo"
                 alt="Zigna Logo">

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
               class="user-link">

               Cerrar sesión

            </a>

            <div class="user-icon">👤</div>

        </div>

    </nav>

</header>

<div class="container">

    <h1 style="text-align:center; margin:20px 0 30px; color:#333;">
    Módulo: Frases LSM
    </h1>

    <?php

    $query =
    "SELECT * FROM Contenido WHERE id_Modulo = 3";

    $resultado =
    mysqli_query($conexion, $query);

    ?>

    <div class="grid">

        <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

            <div class="card">

                <div class="img-container">

                    <img src="<?php echo $fila['imagen']; ?>">

                </div>

                <div class="info">

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

    <div class="btn-container">

        <a href="evaluacionFrases.php"
           class="btn">

           Evaluación ✨

        </a>

    </div>

</div>

</body>
</html>