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

            // Asignar icono según módulo
            $iconos = [1 => '✋', 2 => '💬', 3 => '🗣️'];
            $icono = $iconos[$id_mod] ?? '📚';

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
            $clase_estado = 'no-iniciado';
            $barra_porcentaje = 0;
            
            if ($ultimo_puntaje !== null) {
                $barra_porcentaje = $ultimo_puntaje;
                if ($ultimo_puntaje >= 80) {
                    $estado_modulo = "Completado";
                    $clase_estado = 'completado';
                    $barra_porcentaje = 100;
                } else {
                    $estado_modulo = "En progreso";
                    $clase_estado = 'en-progreso';
                }
            }

            if ($ultimo_puntaje === null || $ultimo_puntaje < 80) {
                $todos_completados = false;
            }
        ?>

        <div class="modulo-card">
            <!-- Encabezado con ícono -->
            <div class="modulo-header">
                <div class="modulo-icono"><?php echo $icono; ?></div>
                <div class="modulo-titulo-wrapper">
                    <h3 class="modulo-titulo"><?php echo htmlspecialchars($nombre_mostrar); ?></h3>
                </div>
            </div>

            <!-- Badge de estado -->
            <div class="estado-badge estado-<?php echo $clase_estado; ?>">
                <?php echo $estado_modulo; ?>
            </div>

            <!-- Barra de progreso -->
            <div class="barra-progreso-container">
                <div class="barra-progreso-fondo">
                    <div class="barra-progreso-llena" style="width: <?php echo $barra_porcentaje; ?>%"></div>
                </div>
                <span class="barra-progreso-texto"><?php echo $ultimo_puntaje !== null ? $ultimo_puntaje . '%' : '0%'; ?></span>
            </div>
            
            <?php
            // Obtener los últimos 3 intentos (historial)
            $query_hist = "SELECT he.fecha, he.puntaje FROM Historial_evaluacion he
                          JOIN Evaluacion e ON he.id_Evaluacion = e.id_Evaluacion
                          WHERE e.id_Modulo = $id_mod AND he.id_Usuario = '$id_usuario'
                          ORDER BY he.fecha DESC LIMIT 3";
            
            $res_hist = mysqli_query($conexion, $query_hist);
            $hay_historial = ($res_hist && mysqli_num_rows($res_hist) > 0);
            ?>
            
            <!-- Sección de historial -->
            <div class="historial-intentos">
                <?php if ($hay_historial): ?>
                    <p class="historial-titulo">Historial de intentos</p>
                    <div class="historial-tabla">
                        <div class="historial-header">
                            <div class="historial-col-fecha">Fecha</div>
                            <div class="historial-col-puntaje">Puntaje</div>
                            <div class="historial-col-resultado">Resultado</div>
                        </div>
                        <?php 
                        while ($intento = mysqli_fetch_assoc($res_hist)): 
                            $fecha_formato = date('d/m/Y', strtotime($intento['fecha']));
                            $hora_formato = date('H:i', strtotime($intento['fecha']));
                            $resultado_icon = $intento['puntaje'] >= 80 ? '✅' : '❌';
                            $resultado_texto = $intento['puntaje'] >= 80 ? 'Aprobado' : 'Reprobado';
                            $clase_resultado = $intento['puntaje'] >= 80 ? 'aprobado' : 'reprobado';
                        ?>
                            <div class="historial-fila">
                                <div class="historial-col-fecha">
                                    <span class="fecha-fecha"><?php echo $fecha_formato; ?></span>
                                    <span class="fecha-hora"><?php echo $hora_formato; ?></span>
                                </div>
                                <div class="historial-col-puntaje"><?php echo $intento['puntaje']; ?>%</div>
                                <div class="historial-col-resultado resultado-<?php echo $clase_resultado; ?>">
                                    <span><?php echo $resultado_icon; ?></span>
                                    <span><?php echo $resultado_texto; ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>                <?php else: ?>
                    <?php
                    // [Sprint 5 - Fallback] Si Historial_evaluacion está vacía, mostrar último intento de Resultado_evaluacion
                    $query_fallback = "SELECT re.fecha, re.puntaje FROM Resultado_evaluacion re
                                      JOIN Evaluacion e ON re.id_Evaluacion = e.id_Evaluacion
                                      WHERE e.id_Modulo = $id_mod AND re.id_Usuario = '$id_usuario'
                                      ORDER BY re.fecha DESC LIMIT 1";
                    
                    $res_fallback = mysqli_query($conexion, $query_fallback);
                    $hay_fallback = ($res_fallback && mysqli_num_rows($res_fallback) > 0);
                    
                    if ($hay_fallback):
                        $intento_fallback = mysqli_fetch_assoc($res_fallback);
                        $fecha_formato_fb = date('d/m/Y', strtotime($intento_fallback['fecha']));
                        $hora_formato_fb = date('H:i', strtotime($intento_fallback['fecha']));
                        $resultado_icon_fb = $intento_fallback['puntaje'] >= 80 ? '✅' : '❌';
                        $resultado_texto_fb = $intento_fallback['puntaje'] >= 80 ? 'Aprobado' : 'Reprobado';
                        $clase_resultado_fb = $intento_fallback['puntaje'] >= 80 ? 'aprobado' : 'reprobado';
                    ?>
                        <p class="historial-titulo">Historial de intentos</p>
                        <div class="historial-tabla">
                            <div class="historial-header">
                                <div class="historial-col-fecha">Fecha</div>
                                <div class="historial-col-puntaje">Puntaje</div>
                                <div class="historial-col-resultado">Resultado</div>
                            </div>
                            <div class="historial-fila">
                                <div class="historial-col-fecha">
                                    <span class="fecha-fecha"><?php echo $fecha_formato_fb; ?></span>
                                    <span class="fecha-hora"><?php echo $hora_formato_fb; ?></span>
                                </div>
                                <div class="historial-col-puntaje"><?php echo $intento_fallback['puntaje']; ?>%</div>
                                <div class="historial-col-resultado resultado-<?php echo $clase_resultado_fb; ?>">
                                    <span><?php echo $resultado_icon_fb; ?></span>
                                    <span><?php echo $resultado_texto_fb; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="historial-vacio">Aún no has realizado esta evaluación</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
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