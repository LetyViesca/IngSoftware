<?php 
// 1. Centralizamos la seguridad y conexión
include __DIR__ . '/../../backend/auth.php'; 
include __DIR__ . '/../../backend/db.php'; 

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Frases LSM</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<?php include __DIR__ . '/../components/header.php'; ?>
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