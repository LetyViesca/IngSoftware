<?php 
// 1. CONTROL DE SEGURIDAD Y CONEXIÓN CENTRALIZADO
include("../backend/auth.php"); 
include("../backend/db.php"); 

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Palabras LSM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA">
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

    <div class="palabras-container">
    <h1 class="palabras-titulo">Módulo: Palabras LSM</h1>

    <?php
    $secciones = ["Saludos" => 0, "Familia" => 6, "Números" => 12];
    foreach ($secciones as $titulo => $offset) { ?>
        
        <h2 class="palabras-subtitulo"><?php echo $titulo; ?></h2>
        
        <div class="palabras-grid">
            <?php
            $query = "SELECT * FROM Contenido WHERE id_Modulo = 2 LIMIT 6 OFFSET $offset";
            $res = mysqli_query($conexion, $query);
            while($fila = mysqli_fetch_assoc($res)) { ?>
                <div class="palabras-card">
                    <div class="palabras-img-container">
                        <img src="<?php echo $fila['imagen']; ?>">
                    </div>
                    <div class="palabras-info">
                        <h3><?php echo htmlspecialchars($fila['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($fila['descripcion']); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="palabras-btn-container">
        <a href="evaluacionPalabras.php" class="palabras-btn">Comenzar Evaluación ✨</a>
    </div>

</body>
</html>