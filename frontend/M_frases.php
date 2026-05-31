<?php 
// 1. Centralizamos la seguridad y conexión
include("../backend/auth.php"); 
include("../backend/db.php"); 

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Frases LSM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Zigna Logo">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li class="dropdown">

    <a href="#">Módulos ▾</a>

    <ul class="dropdown-menu">

        <li>
            <a href="M_abecedario.php">
                Abecedario
            </a>
        </li>

        <li>
            <a href="M_palabras.php">
                Palabras
            </a>
        </li>

        <li>
            <a href="M_frases.php">
                Frases
            </a>
        </li>

    </ul>

</li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
            <a href="login.php" class="user-link" style="text-decoration:none; color:#666; font-size:13px; font-weight:bold;">
                Cerrar sesión
            </a>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>

<div class="container frases-container">
    <h1>Módulo: Frases LSM</h1>

    <?php
    $query = "SELECT * FROM Contenido WHERE id_Modulo = 3";
    $resultado = mysqli_query($conexion, $query);
    ?>

    <div class="grid">
        <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
            <div class="card">
                <div class="img-container">
                    <img src="<?php echo $fila['imagen']; ?>">
                </div>
                <div class="info">
                    <h3><?php echo htmlspecialchars($fila['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($fila['descripcion']); ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="btn-container" style="margin-top:40px;">
        <a href="evaluacionFrases.php" class="btn">Evaluación ✨</a>
    </div>
</div>

</body>
</html>