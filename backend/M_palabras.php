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

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f5f7fa; }

        /* ===== HEADER (CONSISTENTE CON OTROS MÓDULOS) ===== */
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
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .subtitulo {
            margin: 30px 0 15px;
            color: #8a4fff;
            border-left: 5px solid #ff007a;
            padding-left: 10px;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        /* TARJETAS */
        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: 0.25s;
            border: 1px solid #eee;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .img-container {
            height: 160px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .info {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #f9f9f9;
        }

        .info h3 {
            color: #8a4fff;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .info p {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        /* BOTÓN */
        .btn-container {
            text-align: center;
            margin: 50px 0 80px;
        }

        .btn {
            background: linear-gradient(90deg, #8a4fff, #ff007a);
            color: white;
            padding: 14px 40px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }
        .btn:hover { opacity: 0.9; transform: scale(1.05); }

        /* RESPONSIVE */
        @media (max-width: 768px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>

<body>

<header>
    <nav>
        <a href="inicio.php"><img src="imag/Logo_Zigna.png" class="main-logo" alt="ZIGNA"></a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="modulos.php">Módulos</a></li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Estudiante: <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" style="text-decoration:none; color:#666; font-size:13px;">Cerrar sesión</a>
            <div style="background:#ff007a;width:35px;height:35px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;">👤</div>
        </div>
    </nav>
</header>

<div class="container">

  <?php
  include("db.php");

  $query = "SELECT * FROM Contenido WHERE id_Modulo = 2";
  $resultado = mysqli_query($conexion, $query);
 ?>

 <div class="grid">

  <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

    <div class="card">
        <div class="img-container">
            <img src="<?php echo $fila['imagen']; ?>">
        </div>

        <div class="info">
            <h3><?php echo $fila['titulo']; ?></h3>
            <p><?php echo $fila['descripcion']; ?></p>
        </div>
    </div>

 <?php } ?>
</div>

</div>

    <div class="btn-container">
        <a href="evaluacionPalabras.php" class="btn">Comenzar Evaluación ✨</a>
    </div>

</div>

</body>
</html>