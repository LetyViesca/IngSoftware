# ZIGNA

Aplicación PHP puro con sesiones, MySQL y evaluación interactiva para el aprendizaje de Lengua de Señas Mexicana.

## Estructura

- `app/` contiene autenticación, configuración, controladores y vistas.
- `public/` contiene el punto de entrada y los assets estáticos.
- `database/` contiene el esquema base.
- `docs/` contiene documentación y evidencias.

## Ejecución local (XAMPP)

1. Coloca este proyecto dentro de `htdocs` o el directorio del servidor Apache.
2. Inicia Apache y MySQL.
3. Importa `database/database.sql` en phpMyAdmin o MySQL CLI.
4. Accede a `http://localhost/ZIGNA/public/index.php`.
