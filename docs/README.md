# Zigna — Plataforma de Aprendizaje de Lengua de Señas Mexicana (LSM)

Zigna es una plataforma web educativa diseñada para apoyar el aprendizaje de la Lengua de Señas Mexicana (LSM) mediante módulos interactivos, evaluaciones dinámicas y seguimiento personalizado del progreso de cada usuario.

El sistema busca fomentar la inclusión y el acceso al aprendizaje de la LSM a través de una experiencia intuitiva, progresiva y accesible.

---

## Tecnologías utilizadas

### Backend

* **PHP 8** como lenguaje principal para la lógica de negocio, gestión de usuarios, procesamiento de evaluaciones y control del flujo de la aplicación.
* **Apache HTTP Server** mediante XAMPP para el despliegue y ejecución del entorno local.

### Base de datos

* **MySQL** para el almacenamiento persistente de usuarios, módulos, evaluaciones, resultados y progreso de aprendizaje.
* **MySQL Workbench** para la administración y modelado de la base de datos.

### Frontend

* **HTML5** para la estructura y organización del contenido.
* **CSS3** para el diseño visual, estilos responsivos y experiencia de usuario.
* **JavaScript (Vanilla JS)** para la interacción dinámica de las evaluaciones, manipulación del DOM y validaciones del lado del cliente.

### Control de versiones

* **Git** para el control de versiones y seguimiento de cambios.
* **GitHub** para la colaboración entre integrantes del equipo, gestión de ramas y control de integración mediante Pull Requests.

### Herramientas de desarrollo

* **Visual Studio Code** como entorno principal de desarrollo.
* **XAMPP** para la ejecución local de los servicios Apache y MySQL.
* **Trello** para la gestión de tareas y seguimiento de actividades durante los sprints.


---

## Requisitos previos

Antes de ejecutar el proyecto es necesario contar con:

* XAMPP (Apache y MySQL)
* MySQL Workbench
* Git
* Navegador web moderno (Google Chrome, Microsoft Edge o Mozilla Firefox)

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/LetyViesca/IngSoftware.git
```

### 2. Ubicar el proyecto en XAMPP

Colocar la carpeta del proyecto dentro de:

```text
C:/xampp/htdocs/ZIGNA
```

La estructura principal deberá quedar de la siguiente manera:

```text
ZIGNA/
├── app/
├── database/
├── docs/
├── public/
├── .htaccess
└── index.php
```

---

### 3. Crear la base de datos

1. Abrir MySQL Workbench.
2. Crear una conexión local.
3. Seleccionar:

```text
File > Open SQL Script
```

4. Abrir:

```text
database/database.sql
```

5. Ejecutar el script completo.

---

### 4. Configurar la conexión

Verificar los parámetros del archivo:

```text
app/config/db.php
```

Ejemplo:

```php
$host = "localhost";
$port = "3307";
$user = "root";
$pass = "";
$db   = "zigna";
```

---

### 5. Ejecutar el sistema

1. Iniciar Apache.
2. Iniciar MySQL.
3. Abrir en el navegador:

```text
http://localhost/ZIGNA
```

---

## Estructura del proyecto

```text
ZIGNA/
├── app/
│   ├── auth/
│   │   └── logout.php
│   │
│   ├── config/
│   │   └── db.php
│   │
│   ├── controllers/
│   │   ├── g_puntaje.php
│   │   ├── get_preguntas.php
│   │   ├── procesar_login.php
│   │   └── procesar_registro.php
│   │
│   └── views/
│       ├── inicio.php
│       ├── login.php
│       ├── registro_vista.php
│       ├── progreso.php
│       ├── M_abecedario.php
│       ├── M_palabras.php
│       ├── M_frases.php
│       ├── evaluacion.php
│       ├── evaluacionPalabras.php
│       └── evaluacionFrases.php
│
├── database/
│   └── database.sql
│
├── docs/
│   └── Documentación del proyecto
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── img/
│   │   └── js/
│   │
│   ├── controllers/
│   │   └── get_preguntas.php
│   │
│   └── index.php
│
├── .htaccess
└── index.php
```

---

## Funcionalidades principales

### Gestión de usuarios

* Registro de usuarios.
* Inicio de sesión.
* Cierre seguro de sesión.
* Persistencia de datos de progreso.

### Módulos de aprendizaje

#### Abecedario LSM

* Disponible desde el inicio.
* Presenta las 27 letras del alfabeto en LSM.

#### Palabras Clave

* Se desbloquea al aprobar el módulo de Abecedario.
* Incluye vocabulario básico de uso cotidiano.

#### Frases Cotidianas

* Se desbloquea al aprobar el módulo de Palabras Clave.
* Presenta expresiones completas utilizadas en contextos reales.

---

## Sistema de desbloqueo progresivo

Los módulos se habilitan de manera secuencial conforme el usuario demuestra dominio del contenido anterior.

| Módulo            | Requisito                  |
| ----------------- | -------------------------- |
| Abecedario        | Disponible desde el inicio |
| Palabras Clave    | Aprobar Abecedario         |
| Frases Cotidianas | Aprobar Palabras Clave     |

Si el usuario no alcanza el puntaje mínimo requerido, los módulos posteriores permanecen bloqueados.

---

## Evaluaciones dinámicas

El sistema genera evaluaciones dinámicas mediante un banco de preguntas almacenado en la base de datos.

Características:

* Selección aleatoria de preguntas.
* Variación de preguntas entre intentos.
* Orden aleatorio de respuestas.
* Corrección automática.
* Registro de resultados.

Esto evita que los usuarios memoricen el orden de las respuestas y fomenta un aprendizaje más significativo.

---

## Seguimiento de progreso

El sistema registra:

* Avance por módulo.
* Resultados de evaluaciones.
* Historial de intentos.
* Estado de desbloqueo de módulos.

La información permanece almacenada incluso después de cerrar sesión.

---

## Seguridad

Para proteger la estructura interna del proyecto se implementaron medidas de seguridad:

* Restricción del listado de directorios mediante `.htaccess`.
* Separación entre archivos públicos y lógica interna.
* Protección de recursos sensibles del sistema.
* Control de acceso mediante sesiones.

---

## Equipo de desarrollo

| Rol                    | Integrante       |
| ---------------------- | ---------------- |
| Diseñadora             | Leticia Viesca   |
| QA (Quality Assurance) | Dannia Hernández |
| Analista               | Renata Flores    |
| Coordinadora           | Valeria García   |
| Desarrolladora Líder   | Blanca Ruiz      |

---

## Estado del proyecto

**Sprint 5 — Finalizado**

La plataforma cuenta con módulos de aprendizaje funcionales, evaluaciones dinámicas, desbloqueo progresivo de contenido, seguimiento de progreso por usuario y medidas básicas de seguridad para la protección de recursos internos.

El proyecto fue desarrollado bajo una metodología ágil basada en sprints incrementales, incorporando validaciones funcionales y retroalimentación continua durante su construcción.

<!-- Evidencia académica de integración Sprint 5 -->