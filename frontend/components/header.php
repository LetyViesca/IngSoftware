<?php
if (!isset($nombre_usuario)) {
    $nombre_usuario = '';
}
?>
<header>
    <nav>
        <a href="inicio.php">
            <img src="assets/img/Logo_Zigna.png" class="main-logo" alt="ZIGNA Logo">
        </a>

        <ul class="nav-menu">
            <li><a href="inicio.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Módulos ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="M_abecedario.php">Abecedario</a></li>
                    <li><a href="M_palabras.php">Palabras</a></li>
                    <li><a href="M_frases.php">Frases</a></li>
                </ul>
            </li>
            <li><a href="progreso.php">Progreso</a></li>
        </ul>

        <div class="user-box">
            <span class="user-name">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
            <a href="login.php" class="user-signout">Cerrar sesión</a>
            <div class="user-icon">👤</div>
        </div>
    </nav>
</header>
