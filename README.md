# ZIGNA

## Descripción del proyecto

ZIGNA es una plataforma web educativa enfocada en el aprendizaje de Lengua de Señas Mexicana (LSM). El sistema permite a los usuarios registrarse, iniciar sesión, acceder a módulos educativos, realizar evaluaciones y visualizar su progreso académico dentro de la plataforma.

---

# Tecnologías utilizadas

- Frontend: HTML, CSS y JavaScript
- Backend: PHP
- Base de datos: MySQL
- Servidor local recomendado: XAMPP

---

# Estructura general del proyecto

```plaintext
backend/
│
├── css/
├── js/
├── php/
├── docs/
├── index.html
├── menu.html
├── modulo.html
├── evaluacion.html
├── resultados.html
└── README.md
```

---

# Instrucciones de instalación y ejecución

## 1. Instalar XAMPP

Descargar e instalar XAMPP para habilitar Apache y MySQL en un entorno local.

## 2. Iniciar servicios

Desde el panel de control de XAMPP iniciar:

- Apache
- MySQL

## 3. Colocar el proyecto en la carpeta del servidor local

Mover la carpeta del proyecto dentro de:

```plaintext
C:\xampp\htdocs\
```

Ejemplo:

```plaintext
C:\xampp\htdocs\backend
```

> Nota: El nombre de la carpeta puede variar dependiendo del nombre asignado al proyecto local.

## 4. Crear la base de datos

La base de datos puede configurarse utilizando herramientas compatibles como:

- phpMyAdmin
- MySQL Workbench

Crear una base de datos con el nombre:

```plaintext
zigna
```

## 5. Importar el archivo SQL

Importar el archivo `.sql` proporcionado en el proyecto dentro de la base de datos creada previamente.

## 6. Configurar la conexión en PHP

Verificar que la conexión a la base de datos esté correctamente configurada:

```php
$conexion = new mysqli("localhost", "root", "", "zigna");
```

En caso de utilizar un puerto personalizado, agregarlo en la conexión:

```php
$conexion = new mysqli("localhost", "root", "", "zigna", 3306);
```

## 7. Ejecutar el sistema

Abrir el navegador y acceder a:

```plaintext
http://localhost/backend
```

> Nota: La ruta puede cambiar dependiendo del nombre asignado a la carpeta del proyecto.

---

# Flujo principal del sistema

1. Registro de usuario.
2. Inicio de sesión.
3. Acceso a módulos educativos.
4. Visualización de contenido de aprendizaje.
5. Realización de evaluaciones.
6. Retroalimentación de resultados.
7. Visualización de progreso del usuario.

---

# Usuarios de prueba y configuración de base de datos

## Usuario de prueba

```plaintext
Correo: prueba@zigna.com
Contraseña: prueba123
```

## Configuración de base de datos

- Base de datos: `zigna`
- Usuario MySQL: `root`
- Puerto predeterminado de MySQL: `3306`

> Nota: Algunos entornos personalizados pueden utilizar puertos diferentes.

---

# Limitaciones actuales del sistema

- Algunas validaciones avanzadas continúan en desarrollo.
- El sistema aún no cuenta con despliegue en un servidor de producción.
- No se incluye funcionalidad de recuperación de contraseña.
- Algunas características de seguridad continúan en proceso de integración.

---

# Estado actual del proyecto

## Sprint 4 – Calidad, refactorización y requisitos no funcionales

Avance estimado del proyecto: **70%**

## Funcionalidades implementadas

- Interfaces principales del sistema.
- Navegación entre pantallas.
- Módulos educativos.
- Evaluaciones básicas.
- Validaciones iniciales.
- Integración básica con base de datos.

## Funcionalidades pendientes

- Implementación completa de requisitos no funcionales.
- Validaciones de seguridad adicionales.
- Optimización de rendimiento.
- Mejoras de accesibilidad y usabilidad.

---

# Equipo de desarrollo y roles

- Renata Flores — QA
- Valeria García — Analista
- Dannia Hernández — Desarrollador
- Blanca Ruiz — Diseñador
- Leticia Viesca — Coordinador

---

# Estado del proyecto

El proyecto se encuentra en una etapa de mejora continua enfocada en calidad de software, refactorización de código, validaciones, buenas prácticas de desarrollo y fortalecimiento técnico del sistema.
