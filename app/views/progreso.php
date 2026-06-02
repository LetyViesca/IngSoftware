<?php 
require_once __DIR__ . '/../auth/auth.php';
require_once __DIR__ . '/../config/db.php';
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Mi Progreso</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<header>
    <nav>
        <a href="index.php?page=inicio">
            <img src="assets/img/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
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

    <a href="?page=logout" class="user-link">
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
        // [Sprint 5 - Progreso Mejorado] Mostrar estado real y historial
        $query_modulos = "SELECT * FROM Modulo ORDER BY id_Modulo";
        $res_modulos = mysqli_query($conexion, $query_modulos);

        $todos_completados = true;

        while ($mod = mysqli_fetch_assoc($res_modulos)) {
            $id_mod = $mod['id_Modulo'];
            $nombre_mostrar = $mod['nombre'] ?? $mod['nombre_modulo'] ?? "Módulo ".$id_mod;

            // Obtener último puntaje del usuario para el módulo (Resultado_evaluacion)
            $query_ult = "SELECT re.puntaje FROM Resultado_evaluacion re
                          JOIN Evaluacion e ON re.id_Evaluacion = e.id_Evaluacion
                          WHERE e.id_Modulo = $id_mod AND re.id_Usuario = '$id_usuario'
                          ORDER BY re.fecha DESC LIMIT 1";

            $res_ult = mysqli_query($conexion, $query_ult);
            $ultimo_puntaje = null;
            if ($res_ult && mysqli_num_rows($res_ult) > 0) {
                $row = mysqli_fetch_assoc($res_ult);
                $ultimo_puntaje = $row['puntaje'];
            }

            // Determinar estado real del módulo
            $estado_modulo = "No iniciado";
            $clase_borde = 'sin-intento';
            
            if ($ultimo_puntaje !== null) {
                if ($ultimo_puntaje >= 80) {
                    $estado_modulo = "Completado ✅";
                    $clase_borde = 'verde';
                } else {
                    $estado_modulo = "En progreso";
                    $clase_borde = 'naranja';
                }
            }

            if ($ultimo_puntaje === null || $ultimo_puntaje < 80) {
                $todos_completados = false;
            }
        ?>

        <div class="modulo-card <?php echo $clase_borde; ?>">
            <h3 style="color: #8a4fff; margin-bottom: 10px;"><?php echo htmlspecialchars($nombre_mostrar); ?></h3>
            <p><strong>Estado:</strong> <?php echo $estado_modulo; ?></p>
            <p><strong>Último puntaje:</strong> <?php echo $ultimo_puntaje !== null ? $ultimo_puntaje . '%' : '---'; ?></p>
            
            <?php
            // Obtener últimos 5 intentos (historial)
            $query_hist = "SELECT he.fecha, he.puntaje FROM Historial_evaluacion he
                          JOIN Evaluacion e ON he.id_Evaluacion = e.id_Evaluacion
                          WHERE e.id_Modulo = $id_mod AND he.id_Usuario = '$id_usuario'
                          ORDER BY he.fecha DESC LIMIT 5";
            
            $res_hist = mysqli_query($conexion, $query_hist);
            $hay_historial = ($res_hist && mysqli_num_rows($res_hist) > 0);
            ?>
            
            <?php if ($hay_historial): ?>
                <div class="historial-intentos">
                    <p style="margin-bottom: 10px; font-weight: 700; font-size: 0.95rem;">Últimos intentos:</p>
                    <div class="historial-lista">
                        <?php 
                        $idx = 1;
                        while ($intento = mysqli_fetch_assoc($res_hist)): 
                            $fecha_formato = date('d/m/Y H:i', strtotime($intento['fecha']));
                            $resultado = $intento['puntaje'] >= 80 ? '✅ Aprobado' : '❌ Reprobado';
                            $color = $intento['puntaje'] >= 80 ? '#008000' : '#ff4757';
                        ?>
                            <div class="historial-item">
                                <span class="historial-fecha"><?php echo $fecha_formato; ?></span>
                                <span class="historial-puntaje"><?php echo $intento['puntaje']; ?>%</span>
                                <span class="historial-resultado" style="color: <?php echo $color; ?>;"><?php echo $resultado; ?></span>
                            </div>
                        <?php 
                            $idx++;
                        endwhile; 
                        ?>
                    </div>
                </div>
            <?php else: ?>
                <p style="margin-top: 10px; color: #999; font-size: 0.9rem;">Sin intentos registrados</p>
            <?php endif; ?>
        </div>

        <?php } ?>

        <?php if ($todos_completados): ?>
            <div class="banner-completado" style="grid-column: 1/-1; text-align: center; padding:20px; background: linear-gradient(90deg,#ffd54f,#ffb74d); border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.06); margin-top:18px;">
                <h2 style="margin:0;">🏆 ¡Felicidades! Completaste el curso Zigna</h2>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>