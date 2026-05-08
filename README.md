# ZIGNA

## Descripción del proyecto
ZIGNA es una plataforma web educativa enfocada en el aprendizaje de Lengua de Señas Mexicana (LSM). El sistema permite a los usuarios registrarse, iniciar sesión, acceder a módulos educativos, realizar evaluaciones y visualizar su progreso.

---

## Tecnologías utilizadas

* Frontend: HTML, CSS, JavaScript
* Backend: PHP
* Base de datos: MySQL
* Servidor local: XAMPP

---

## Estructura del proyecto

```plaintext
ZIGNA/
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

## 🚀 Instrucciones de instalación y ejecución

1. Instalar XAMPP.

2. Iniciar los servicios:
   - Apache
   - MySQL

3. Colocar la carpeta del proyecto en:

```plaintext
C:\xampp\htdocs\zigna
```

4. Abrir phpMyAdmin desde:

```plaintext
http://localhost/phpmyadmin
```

5. Crear una base de datos llamada:

```plaintext
zigna
```

6. Importar el archivo `.sql` del proyecto.

7. Configurar la conexión en PHP:

```php
$conexion = new mysqli("localhost", "root", "", "zigna");
```

8. Ejecutar el sistema desde el navegador:

```plaintext
http://localhost/zigna
```

---

## Flujo principal del sistema

1. Registro de usuario.
2. Inicio de sesión.
3. Acceso a módulos de aprendizaje.
4. Visualización de contenido educativo.
5. Realización de evaluaciones.
6. Retroalimentación de resultados.
7. Actualización de progreso.

---

## Usuarios de prueba y configuración de base de datos

### Usuario de prueba

```plaintext
Correo: prueba@zigna.com
Contraseña: prueba123
```

### Configuración de base de datos

* Base de datos: `zigna`
* Usuario MySQL: `root`
* Puerto por defecto: `3307`

---

## Limitaciones del sistema

* Algunas validaciones avanzadas continúan en desarrollo.
* No se cuenta con despliegue en servidor de producción.
* No incluye recuperación de contraseña.


---

## Estado actual del proyecto

### Sprint 4 – Calidad, Refactorización, Requisitos no funcionales y Buenas prácticas.

Avance estimado: **70%**

### Funcionalidades implementadas

* Interfaces principales
* Navegación entre pantallas
* Módulos educativos
* Evaluaciones básicas
* Validaciones iniciales

### Funcionalidades pendientes

* Integración de Requisitos No Funcionales y Validaciones de Seguridad
  

---

## Equipo y roles

* Renata Flores → QA
* Valeria García → Analista
* Dannia Hernández → Desarrollador
* Blanca Ruiz → Diseñador
* Leticia Viesca → Cordinador


  ## Estado del Proyecto: 

Evolucionar del "¿Funciona?" al "¿Funciona bien y puede defenderse técnicamente?".
