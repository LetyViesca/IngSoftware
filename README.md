# ZIGNA - Plataforma Educativa de Lengua de Señas Mexicana (LSM)

## Descripción del proyecto
ZIGNA es una plataforma web educativa diseñada para facilitar el aprendizaje de la Lengua de Señas Mexicana (LSM). El sistema permite gestionar el ciclo completo de aprendizaje del usuario, desde el registro y autenticación segura hasta la interacción con módulos educativos y la ejecución de evaluaciones con monitoreo de progreso en tiempo real.

## Tecnologías y arquitectura
El proyecto implementa una arquitectura de **separación de capas** para mejorar la mantenibilidad y seguridad:

* **Directorio `backend/`**: Lógica de servidor y control de datos.
    * `db.php`: Conexión centralizada a la BD.
    * `procesar_registro.php` / `procesar_login.php`: Controladores de formularios con validaciones robustas.
* **Directorio `frontend/`**: Interfaz de usuario y recursos públicos.
    * `registro_vista.php`, `login_vista.php`, `inicio.php`: Vistas principales.
    * `css/` y `js/`: Estilos responsivos y validaciones dinámicas del lado del cliente.

## Requisitos No Funcionales (RNF) Implementados
* **RNF-01 (Seguridad)**: Cifrado de credenciales mediante `password_hash` (Bcrypt).
* **RNF-02 (Integridad)**: Prevención de Inyección SQL mediante **Consultas Preparadas** en toda la capa de `backend/`.
* **RNF-03 (Validación de Datos)**: Implementación de filtros de servidor (`filter_var`) para asegurar estructuras de correo válidas y limpieza de inputs.
* **RNF-04 (Diseño Adaptativo)**: Interfaz optimizada para dispositivos móviles mediante `media queries`, corrigiendo desalineaciones en la sección de progreso.

---

## Instrucciones de instalación y ejecución

### 1. Preparación del entorno
Es necesario contar con un servidor local activo (ej. **XAMPP**) con los servicios de Apache y MySQL iniciados.

### 2. Ubicación del proyecto y ejecución
Colocar la carpeta raíz del proyecto (`IngSoftware`) dentro del directorio `C:\xampp\htdocs\`. 

**Nota de acceso:** Por la separación de capas, el ingreso no es directo en la raíz. Se debe utilizar la siguiente ruta específica para evitar errores de carga de scripts del backend:
> [http://localhost/IngSoftware/frontend/inicio.php](http://localhost/IngSoftware/frontend/inicio.php)

### 3. Configuración de la base de datos
1.  Crear una base de datos denominada: `zigna`.
2.  Importar el archivo `database.sql` ubicado en la raíz del proyecto.
3.  **Nota técnica**: La columna `contra` en la tabla `usuarios` debe tener una longitud de **VARCHAR(255)** para soportar el hash de Bcrypt.

### 4. Configuración de conexión (Capa Backend)
El archivo de configuración central se encuentra en: `INGSOFTWARE/backend/db.php`  
Asegúrese de que las credenciales coincidan con su servidor local (Usuario: `root`, Puerto: `3306`).

### 5. Acceso al sistema (Punto de Entrada Único)
Para garantizar el correcto funcionamiento de la arquitectura de capas, el acceso debe realizarse **exclusivamente** a través de la interfaz de usuario. La carpeta `backend/` contiene lógica de servidor y no es navegable.

**URL Directa de Inicio:**
> [http://localhost/IngSoftware/frontend/inicio.php](http://localhost/IngSoftware/frontend/inicio.php)

*Nota: Cualquier intento de acceso a través de la raíz o la carpeta `/backend/` resultará en errores de navegación o denegación de acceso por diseño de seguridad.*

---

## Flujo de Trabajo y Estructura de Rutas
* **Vistas**: Residen en `/frontend/` y consumen servicios de `/backend/`.
* **Procesamiento**: Los formularios envían peticiones a `../backend/nombre_archivo.php`.
* **Mensajes de error**: El sistema traduce códigos técnicos a mensajes amigables mediante parámetros `GET` gestionados en las vistas de registro y login.

## Equipo de desarrollo
* **Leticia Viesca** — Coordinadora
* **Dannia Hernández** — Desarrolladora
* **Renata Flores** — QA (Quality Assurance)
* **Valeria García** — Analista
* **Blanca Ruiz** — Diseñadora

## Estado del proyecto
**Sprint 4 - Finalizado**

* Atendidas observaciones de QA sobre validaciones de correo y diseño responsive.
* Implementada traducción de errores técnicos a mensajes de usuario final.
