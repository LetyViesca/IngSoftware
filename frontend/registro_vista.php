<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Registro</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Contenedor del mensaje de error original en rojo (Mantiene tu diseño intacto) */
        .error-msg {
            background-color: #ffeef2;
            color: #ff007a;
            border: 1px solid rgba(255, 0, 122, 0.2);
            padding: 12px;
            border-radius: 14px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        /* DISEÑO DE MODAL PROFESIONAL ADAPTADO A ZIGNA */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(31, 36, 48, 0.25); /* Tono oscuro sutil translúcido */
            backdrop-filter: blur(8px); /* Difuminado premium para el fondo */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .modal-content {
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 24px; /* Copia el radio de curvatura de tu login-card */
            width: 90%;
            max-width: 380px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(31, 36, 48, 0.08); /* Sombra suave y profesional */
            animation: professionalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        }

        /* Icono de check estilizado con tu paleta de color */
        .modal-icon {
            width: 60px;
            height: 60px;
            background-color: #e6f9f3;
            color: #2cc19c;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            margin: 0 auto 20px auto;
            font-weight: bold;
        }
        
        .modal-content h3 {
            color: #1f2430; /* El color de texto principal de tus estilos */
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        .modal-content p {
            color: #5c667f; /* Color de texto secundario suave */
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.5;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        .btn-modal {
            background-color: #2cc19c; /* Verde/Turquesa corporativo ZIGNA */
            color: white;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 4px 12px rgba(44, 193, 156, 0.2);
            transition: all 0.2s ease;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        .btn-modal:hover {
            background-color: #24a885;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(44, 193, 156, 0.3);
        }

        .btn-modal:active {
            transform: translateY(1px);
        }

        @keyframes professionalPop {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="login-logo-container" style="display: flex !important; justify-content: center !important; align-items: center !important; width: 100% !important; margin-bottom: 15px !important;">
            <img src="imag/Logo_Zigna.png" alt="ZIGNA" class="logo-login" style="height: 45px !important; width: auto !important; margin: 0 auto !important; display: block !important;">
        </div>

        <h2>Crea tu cuenta</h2>

        <?php
        // 1. SI ES EXITOSO: Muestra la ventana emergente premium y espera obligatoriamente el clic del usuario
        if(isset($_GET['status']) && $_GET['status'] == 'exito'){
            echo "
            <div class='modal-overlay'>
                <div class='modal-content'>
                    <div class='modal-icon'>✓</div>
                    <h3>¡Registro exitoso!</h3>
                    <p>Tu cuenta ha sido creada correctamente en ZIGNA. Ya puedes acceder con tus credenciales.</p>
                    <button class='btn-modal' onclick='redirigirLogin()'>Aceptar</button>
                </div>
            </div>
            <script>
                function redirigirLogin() {
                    window.location.href = 'login.php';
                }
            </script>
            ";
        }

        // 2. SI ES FALLO: Muestra el mensaje original de error en rojo arriba de los inputs
        if(isset($_GET['error'])){

            $mensaje = "";

            switch($_GET['error']){

                case 'formato_nombre':
                    $mensaje = "El nombre y los apellidos solo deben contener letras.";
                break;

                case 'correo_invalido':
                    $mensaje = "Ingresa un correo electrónico válido.";
                break;

                case 'correo_duplicado':
                    $mensaje = "Ese correo ya está registrado.";
                break;

                case 'contra_corta':
                    $mensaje = "La contraseña debe tener mínimo 8 caracteres.";
                break;

                case 'tecnico':
                    $mensaje = "Ocurrió un error al registrar la cuenta.";
                break;

                default:
                    $mensaje = "Ocurrió un error inesperado.";
            }

            echo "<div class='error-msg'>$mensaje</div>";
        }
        ?>

        <form action="../backend/procesar_registro.php" method="POST">
            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="nombres" placeholder="Tu nombre" required>
            </div>
            
            <div class="input-group">
                <label>Apellido Paterno</label>
                <input type="text" name="paterno" placeholder="Apellido paterno" required>
            </div>
            
            <div class="input-group">
                <label>Apellido Materno</label>
                <input type="text" name="materno" placeholder="Apellido materno" required>
            </div>
            
            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
            </div>
            
            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="contra" placeholder="Mínimo 8 caracteres" minlength="8" required>
            </div>
            
            <button type="submit" class="btn-login">Crear Cuenta</button>
        </form>

        <div style="margin-top:20px; font-size:13px; color:#888;">
            ¿Ya tienes cuenta? 
            <a href="login.php" style="color:#2cc19c; text-decoration:none; font-weight:bold;">
                Inicia sesión
            </a>
        </div>
    </div>
</body>
</html>