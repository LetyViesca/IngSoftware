<?php include __DIR__ . '/../../backend/auth.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIGNA - Inicio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <style>
        /* Asegura que el círculo morado quede SIEMPRE al frente de la imagen en el zoom */
        .badge {
            position: absolute;
            z-index: 10 !important;
        }

        /* Preparamos las imágenes dándoles una animación suave y fluida */
        .card-img, 
        .img-container img, 
        .module-card img {
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            cursor: pointer;
            position: relative;
            z-index: 1;
        }

        /* Al pasar el cursor sobre la tarjeta, la imagen hace el zoom sin tapar la letra */
        .module-card:hover .card-img,
        .module-card:hover img {
            transform: scale(1.06) !important;
        }
    </style>
</head>
<body>

<?php include __DIR__ . '/../components/header.php'; ?>
<main>
    <section class="hero-section">
        <div class="hero-card">
            <h1>Sigue el aprendizaje en <span class="zigna-text">ZIGNA</span></h1>
            <p style="color:#666; line-height: 1.6; margin-top: 10px;">
                ¡Tu camino hacia la inclusión comienza aquí!<br>

En ZIGNA, no solo aprendes señas construyes puentes. Estás a un paso de dominar la Lengua de Señas Mexicana a través de módulos interactivos diseñados para que practiques a tu ritmo. Revisa tu progreso, supera desafíos y desbloquea una nueva forma de conectar con el mundo.
<br>
¿Listo para hacer que tus manos hablen?
            </p>
        </div>
    </section>

    <section class="learning-guide">
        <h2 style="color: #333; margin-bottom: 25px; font-size: 24px; font-weight: bold;">Tus Módulos de Aprendizaje</h2>
        
        <div class="card-grid">

            <div class="module-card">
                <div class="img-container" style="position: relative;">
                    <span class="badge">A</span>
                    <img src="assets/img/abecedario/a.png" class="card-img" alt="Abecedario">
                </div>
                <div class="card-info">
                    <h3>El Abecedario</h3>
                    <p>Aprende cada letra para deletrear nombres y palabras comunes.</p>
                    <a href="m_abecedario.php">
                        <button class="btn-card" style="background:#8a4fff">▶ Seguir aprendiendo</button>
                    </a>
                </div>
            </div>

            <div class="module-card">
                <div class="img-container" style="position: relative;">
                    <span class="badge">P</span>
                    <img src="assets/img/palabras/uno.png" class="card-img" alt="Palabras">
                </div>
                <div class="card-info">
                    <h3>Palabras Clave</h3>
                    <p>Aprende vocabulario esencial del día a día.</p>
                    <a href="m_palabras.php">
                        <button class="btn-card" style="background:#00c2a8">▶ Seguir aprendiendo</button>
                    </a>
                </div>
            </div>

            <div class="module-card">
                <div class="img-container" style="position: relative;">
                    <span class="badge">F</span>
                    <img src="assets/img/frases/sed.png" class="card-img" alt="Frases">
                </div>
                <div class="card-info">
                    <h3>Frases Cotidianas</h3>
                    <p>Comienza a comunicarte usando frases completas.</p>
                    <a href="m_frases.php">
                        <button class="btn-card" style="background:#ff007a">▶ Seguir aprendiendo</button>
                    </a>
                </div>
            </div>

        </div>
    </section>
</main>

</body>
</html>