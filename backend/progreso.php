<?php
session_start();
include("db.php");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Resultados</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* ===== HEADER ===== */
        header { background: white; padding: 10px 5%; border-bottom: 1px solid #f0f0f0; }
        nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .main-logo { height: 35px; }
        .nav-menu { list-style: none; display: flex; gap: 15px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; transition: 0.3s; }
        .nav-menu a:hover { color: #8a4fff; }

        .user-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-name { font-size: 13px; font-weight: 600; color: #555; }

        /* ===== CONTENIDO ===== */
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        /* ===== TARJETAS ===== */
        .modulo-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        /* COLORES DINÁMICOS */
        .verde { border-left: 8px solid #00c853; }
        .naranja { border-left: 8px solid #ff9800; }
        .sin-intento { border-left: 8px solid #ccc; }

        /* ===== BARRA ===== */
        .progress-bar {
            width: 100%;
            height: 12px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: #ccc;
            transition: width 0.8s ease-in-out;
        }

        .verde .progress-fill { background: #00c853; }
        .naranja .progress-fill { background: #ff9800; }

        .estado {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php">
            <img src="imag/Logo_Zigna.png" class="main-logo" alt="Logo Zigna">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size:14px; font-weight: bold;">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">

    <h2>Tu Progreso en ZIGNA</h2>

    <div class="grid-progreso">

 <?php 
 $modulos = [
    1 => "Abecedario",
    2 => "Palabras Clave",
    3 => "Frases Comunes"
];

foreach($modulos as $id => $nombre) {

    $sql = "SELECT * FROM Progreso 
            WHERE id_Usuario = '$id_usuario'
            AND id_Modulo = '$id'
            LIMIT 1";

    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $fila = mysqli_fetch_assoc($resultado);

        $estado = $fila['estado'];
        $lecciones = $fila['lecciones_completadas'];
        $fecha = $fila['fecha_ultimo_acceso'];

    } else {

        $estado = "No iniciado";
        $lecciones = 0;
        $fecha = "Sin actividad";
    }
?>

<div class="modulo-card">

    <h2><?php echo $nombre; ?></h2>

    <p>
        Estado:
        <?php echo $estado; ?>
    </p>

    <p>
        Lecciones completadas:
        <?php echo $lecciones; ?>
    </p>

    <p>
        Último acceso:
        <?php echo $fecha; ?>
    </p>

</div>

<?php } ?>

</div>

<script>
    /* 🔥 LÓGICA DE PERSISTENCIA (QA Test) */
    function obtenerResultado(modulo) {
        // Obtenemos los datos del localStorage (se guardan desde evaluacion.php)
        return localStorage.getItem("resultado_" + modulo);
    }

    function pintarModulo(modulo) {
        const valor = obtenerResultado(modulo);
        const card = document.getElementById(modulo);
        const barra = document.getElementById("bar-" + modulo);
        const estado = document.getElementById("estado-" + modulo);

        if (!valor) {
            card.classList.add("sin-intento");
            estado.innerText = "No has realizado la evaluación";
            barra.style.width = "0%";
            return;
        }

        const porcentaje = parseInt(valor);
        
        // Pequeño retardo para que se vea la animación de la barra
        setTimeout(() => {
            barra.style.width = porcentaje + "%";
        }, 200);

        if (porcentaje >= 70) {
            card.classList.add("verde");
            estado.innerText = "✔ Aprobado (" + porcentaje + "%)";
        } else {
            card.classList.add("naranja");
            estado.innerText = "⚠ En progreso (" + porcentaje + "%)";
        }
    }

    // Inicializamos las tarjetas
    pintarModulo("abecedario");
    pintarModulo("palabras");
    pintarModulo("frases");
</script>

</body>
</html>