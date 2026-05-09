<?php
session_start();

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
    <title>ZIGNA - Abecedario LSM</title>

    <link rel="stylesheet" href="styles.css">
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
            <span class="user-name">
                Hola, <?php echo htmlspecialchars($nombre_usuario); ?>
            </span>

            <a href="logout.php"
               style="text-decoration:none; color:#666; font-size:13px;">
               Cerrar sesión
            </a>

            <div class="user-icon">👤</div>
        </div>

    </nav>
</header>

<div class="container">

    <h1 class="titulo-modulo">
        Abecedario en Lengua de Señas Mexicana
    </h1>

    <div class="palabras-grid" id="grid"></div>

    <div class="btn-container">
        <a href="evaluacion.php" class="btn-ready">
            Comenzar Evaluación ✨
        </a>
    </div>

</div>

<script>

const letras = [

["A","Se cierra la mano con los dedos juntos, se muestran las uñas y el pulgar se coloca a un lado."],

["B","La mano se coloca abierta con los dedos juntos y estirados, el pulgar doblado hacia la palma."],

["C","Los dedos y el pulgar se curvan formando la figura de la letra C."],

["D","El dedo índice se mantiene estirado mientras los demás dedos se unen con el pulgar."],

["E","Los dedos se doblan completamente hacia la palma mostrando las uñas."],

["F","El dedo índice toca el pulgar formando un círculo, los demás dedos permanecen estirados."],

["G","El pulgar y el índice se mantienen estirados en forma horizontal."],

["H","El índice y el medio se mantienen estirados y juntos en posición horizontal."],

["I","El dedo meñique se mantiene estirado mientras los demás permanecen cerrados."],

["J","Con el dedo meñique estirado se traza en el aire la forma de la letra J."],

["K","El pulgar, índice y medio se estiran formando una figura similar a la letra K."],

["L","El pulgar y el índice forman un ángulo recto simulando la letra L."],

["M","Tres dedos se colocan sobre el pulgar cerrado."],

["N","Dos dedos se colocan sobre el pulgar cerrado."],

["Ñ","Se realiza el mismo gesto que la N pero con un movimiento lateral."],

["O","Todos los dedos se juntan formando un círculo."],

["P","Se forma como la K pero inclinada hacia abajo."],

["Q","La mano adopta una forma similar a una garra con movimiento hacia abajo."],

["R","El índice y el medio se cruzan entre sí."],

["S","Se cierra el puño con el pulgar por fuera."],

["T","El pulgar se coloca entre el índice y el medio."],

["U","El índice y el medio se mantienen juntos y estirados."],

["V","El índice y el medio se separan formando una V."],

["W","Tres dedos se mantienen estirados y separados."],

["X","El índice se curva formando un gancho."],

["Y","El pulgar y el meñique se estiran mientras los demás permanecen cerrados."],

["Z","Con el dedo índice se dibuja la forma de la letra Z en el aire."]
];

const grid = document.getElementById("grid");

letras.forEach(l => {

    grid.innerHTML += `
    
    <div class="card-palabra">

        <div class="img-palabra-container">

            <span class="badge-palabra">
                Dactilología
            </span>

            <img src="imag/abecedario/${l[0].toLowerCase()}.png"
                 alt="Letra ${l[0]}">

        </div>

        <div class="info-palabra">

            <h3>${l[0]}</h3>

            <p>${l[1]}</p>

        </div>

    </div>
    
    `;
});

</script>

</body>
</html>