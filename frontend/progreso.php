<?php
session_start();
include("../backend/db.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZIGNA - Resultados</title>

    <link rel="stylesheet" href="styles.css">

</head>

<body>

<header>

    <nav>

        <a href="inicio.php">

            <img src="imag/Logo_Zigna.png"
                 class="main-logo"
                 alt="Logo Zigna">

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

    <h2 class="titulo-progreso">

        Tu Progreso en ZIGNA

    </h2>

    <div class="grid-progreso">

        <?php

        $modulos = [

            1 => "Abecedario",
            2 => "Palabras Clave",
            3 => "Frases Comunes"

        ];

        foreach($modulos as $id => $nombre) {

            $sql =
            "SELECT * FROM Progreso
             WHERE id_Usuario = '$id_usuario'
             AND id_Modulo = '$id'
             LIMIT 1";

            $resultado =
            mysqli_query($conexion, $sql);

            if(mysqli_num_rows($resultado) > 0){

                $fila =
                mysqli_fetch_assoc($resultado);

                $estado =
                $fila['estado'];

                $lecciones =
                $fila['lecciones_completadas'];

                $fecha =
                $fila['fecha_ultimo_acceso'];

            } else {

                $estado = "No iniciado";
                $lecciones = 0;
                $fecha = "Sin actividad";
            }

            $clase = "sin-intento";

            if($estado == "Completado"){
                $clase = "verde";
            }

            if($estado == "En progreso"){
                $clase = "naranja";
            }
        ?>

        <div class="modulo-card <?php echo $clase; ?>">

            <h3><?php echo $nombre; ?></h3>

            <p>

                <strong>Estado:</strong>
                <?php echo $estado; ?>

            </p>

            <p>

                <strong>Lecciones completadas:</strong>
                <?php echo $lecciones; ?>

            </p>

            <p>

                <strong>Último acceso:</strong>
                <?php echo $fecha; ?>

            </p>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>