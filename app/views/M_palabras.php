<?php 
// 1. CONTROL DE SEGURIDAD Y CONEXIÓN CENTRALIZADO
require_once __DIR__ . '/../auth/auth.php';
require_once __DIR__ . '/../config/db.php';

$nombre_usuario = $_SESSION['nombre_usuario'];

// [Sprint 5 - RNF-01] Verificar desbloqueo: Palabras requiere haber completado Abecedario
$id_usuario = $_SESSION['id_usuario'];
$query_prev = "SELECT re.puntaje FROM Resultado_evaluacion re JOIN Evaluacion e ON re.id_Evaluacion = e.id_Evaluacion WHERE re.id_Usuario = '$id_usuario' AND e.id_Modulo = 1 AND re.puntaje >= 80 LIMIT 1";
$res_prev = mysqli_query($conexion, $query_prev);
if (!$res_prev || mysqli_num_rows($res_prev) == 0) {
    header('Location: index.php?page=inicio&msg=locked');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Palabras LSM</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<header>
    <nav>
        <a href="index.php?page=inicio">
            <img src="assets/img/Logo_Zigna.png" class="main-logo" alt="ZIGNA">
        </a>

        <ul class="nav-menu">
            <li><a href="index.php?page=inicio">Inicio</a></li>
            <li class="dropdown">

    <a href="#">Módulos ▾</a>

    <ul class="dropdown-menu">

        <li>
            <a href="index.php?page=m_abecedario">
                Abecedario
            </a>
        </li>

        <li>
            <a href="index.php?page=m_palabras">
                Palabras
            </a>
        </li>

        <li>
            <a href="index.php?page=m_frases">
                Frases
            </a>
        </li>

    </ul>

</li>
            <li><a href="index.php?page=progreso">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
            <a href="?page=logout" class="user-link" style="text-decoration:none; color:#666; font-size:13px; font-weight:bold;">
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
            while($fila = mysqli_fetch_assoc($res)) { 
                $imagen = $fila['imagen'];
                $imagen = str_replace('imag/', 'assets/img/', $imagen);
                $imagen = str_replace('../frontend/imag/', 'assets/img/', $imagen);
                $imagen = str_replace('frontend/imag/', 'assets/img/', $imagen);
            ?>
                <div class="palabras-card">
                    <div class="palabras-img-container">
                        <img src="<?php echo $imagen; ?>">
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
        <a href="index.php?page=evaluacionPalabras" class="palabras-btn">Comenzar Evaluación ✨</a>
    </div>

</body>
</html>