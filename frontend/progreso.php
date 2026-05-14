<?php 
include("../backend/auth.php"); 
include("../backend/db.php"); 
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
=======
>>>>>>> e33db39af2be16c54559c831c68c9be6d323f2be
    <title>ZIGNA - Mi Progreso</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
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

    <a href="login.php" class="user-link">
        Cerrar sesión
    </a>

    <div class="user-icon">👤</div>

</div>
    </nav>
</header>

<div class="container">
    <h2 class="titulo-progreso" style="margin-top: 30px;">Mi Progreso en LSM</h2>

    <div class="grid-progreso">
        <?php
        $query_modulos = "SELECT * FROM Modulo";
        $res_modulos = mysqli_query($conexion, $query_modulos);

        while ($mod = mysqli_fetch_assoc($res_modulos)) {
            $id_mod = $mod['id_Modulo'];
            
            // Usamos el nombre real de la columna de tu base de datos
            $nombre_mostrar = $mod['nombre'] ?? $mod['nombre_modulo'] ?? "Módulo ".$id_mod;

            $query_prog = "SELECT * FROM Progreso WHERE id_Usuario = '$id_usuario' AND id_Modulo = '$id_mod'";
            $res_prog = mysqli_query($conexion, $query_prog);
            $datos_prog = mysqli_fetch_assoc($res_prog);

            $clase_borde = "sin-intento";
            $estado_texto = "No iniciado";
            
            if ($datos_prog) {
                $estado_texto = $datos_prog['estado'];
                $clase_borde = ($estado_texto == 'Completado') ? 'verde' : 'naranja';
            }
        ?>

        <div class="modulo-card <?php echo $clase_borde; ?>">
            <h3 style="color: #8a4fff; margin-bottom: 10px;"><?php echo htmlspecialchars($nombre_mostrar); ?></h3>
            <p><strong>Estado:</strong> <?php echo $estado_texto; ?></p>
            <p><strong>Último acceso:</strong> <?php echo $datos_prog['fecha_ultimo_acceso'] ?? '---'; ?></p>
        </div>

        <?php } ?>
    </div>
</div>

</body>
</html>