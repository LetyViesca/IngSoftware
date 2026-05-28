<?php

session_start();

// Vaciar sesión
$_SESSION = [];

// Destruir sesión
session_destroy();

// Eliminar cookie de sesión
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirigir al login
header("Location: ../../public/index.php?page=login");
exit();
