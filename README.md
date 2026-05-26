# ZIGNA

Plataforma web de aprendizaje de Lengua de Señas Mexicana (LSM) organizada para desarrollo profesional y compatibilidad con XAMPP.

## Estructura del proyecto

- `/frontend`
  - `/frontend/assets/css` → Estilos separados por módulos y hoja de entrada principal.
  - `/frontend/assets/js` → Scripts del lado del cliente.
  - `/frontend/assets/img` → Imágenes del proyecto organizadas por secciones.
  - `/frontend/components` → Componentes reutilizables de interfaz.
  - `/frontend/views` → Vistas principales del sistema.
  - `/frontend/*.php` → Envoltorios de compatibilidad que cargan las vistas.

- `/backend`
  - `/backend/config` → Configuración central, incluida la conexión a la base de datos.
  - `/backend/controllers` → Procesadores y controladores de formularios.
  - `/backend/middleware` → Lógica de control de acceso por sesión.
  - `/backend/models` → Carpeta preparada para modelos de dominio.
  - `/backend/helpers` → Carpeta preparada para utilidades y helpers.
  - `/backend/*.php` → Stubs de compatibilidad que redirigen a la nueva arquitectura.

- `/docs`
  - Documentación del proyecto, mejoras, validación y evidencia de sprint.
  - `/docs/evidencias`
  - `/docs/sprints`
  - `/docs/testing`

## Flujo general del sistema

1. El usuario accede a una página de frontend dentro de `/frontend/`.
2. Los archivos root en `/frontend/` cargan sus vistas desde `/frontend/views/`.
3. Las vistas consumen servicios PHP del backend mediante `../backend/`.
4. La conexión a MySQL se centraliza en `/backend/config/db.php`.
5. El middleware de sesión se ubica en `/backend/middleware/auth.php`.

## Archivos clave

- `/frontend/login.php` → Entrada para la página de login.
- `/frontend/registro_vista.php` → Página de registro de usuarios.
- `/frontend/inicio.php` → Dashboard principal del alumno.
- `/frontend/M_abecedario.php`, `/frontend/M_palabras.php`, `/frontend/M_frases.php` → Vistas de módulo.
- `/frontend/progreso.php` → Seguimiento de progreso.
- `/backend/controllers/procesar_login.php` → Procesa el inicio de sesión.
- `/backend/controllers/procesar_registro.php` → Procesa el registro de nuevo usuario.
- `/backend/controllers/g_puntaje.php` → Guarda puntajes de evaluación.
- `/backend/config/db.php` → Configuración de conexión MySQL.

## Ejecución en XAMPP

1. Copia la carpeta `IngSoftware` en `C:\xampp\htdocs\`.
2. Inicia Apache y MySQL desde el panel de XAMPP.
3. Importa `/datos/database.sql` en MySQL.
4. Accede desde el navegador a:

   `http://localhost/IngSoftware/frontend/login.php`

## Notas importantes

- El proyecto conserva compatibilidad con las rutas existentes gracias a los wrappers root en `/frontend/` y los stubs de backend en `/backend/`.
- La arquitectura se reorganizó para facilitar el mantenimiento sin cambiar la lógica de negocio.
- Se agregó `.gitignore` profesional en la raíz para excluir archivos temporales, logs, `.env`, `node_modules` y artefactos de editor.
