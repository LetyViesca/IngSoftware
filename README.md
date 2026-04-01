# ZIGNA

ZIGNA es una plataforma web diseñada para apoyar el aprendizaje de la Lengua de Señas Mexicana (LSM). El sistema permite a los usuarios registrarse, acceder a contenidos educativos (alfabeto, palabras y frases), realizar evaluaciones y dar seguimiento a su progreso.


## Tecnologías Utilizadas

* Frontend: HTML, CSS, JavaScript
* Backend: PHP
* Base de Datos: MySQL
* Servidor Local: XAMPP


##  Instrucciones de Ejecución

Para ejecutar el sistema de manera local, seguir los siguientes pasos:

1. Instalar XAMPP.

2. Iniciar los servicios de:

   * Apache
   * MySQL

3. Colocar la carpeta del proyecto en:

   C:\xampp\htdocs\
 
4. Importar la base de datos:

   * Abrir phpMyAdmin (http://localhost/phpmyadmin)
   * Crear una base de datos llamada: `zigna`
   * Importar el archivo `.sql` del proyecto

5. Configurar la conexión a la base de datos en el archivo PHP correspondiente:
  php
   $conexion = new mysqli("localhost", "root", "", "zigna");
6. Ejecutar el sistema en el navegador:
   http://localhost/zigna

##  Arquitectura del Sistema

El sistema ZIGNA sigue una arquitectura de tres capas:

### 1. Frontend

Es la interfaz con la que interactúa el usuario. Está desarrollada con HTML, CSS y JavaScript. Aquí se muestran los formularios, módulos y evaluaciones.

### 2. Backend (PHP)

Se encarga de procesar la lógica del sistema, validar datos, gestionar sesiones y comunicarse con la base de datos.

### 3. Base de Datos (MySQL)

Almacena la información del sistema:

* Usuarios registrados
* Progreso del usuario
* Resultados de evaluaciones

### Flujo de comunicación

1. El usuario interactúa con el Frontend.
2. El Frontend envía solicitudes al Backend.
3. El Backend procesa la información.
4. Se consulta o actualiza la Base de Datos.
5. El Backend responde al Frontend.
6. El usuario visualiza el resultado.

##  Funcionalidades Principales

* Registro de usuario
* Inicio de sesión
* Acceso a módulos de aprendizaje
* Evaluaciones interactivas
* Retroalimentación de resultados
* Seguimiento de progreso


##  Reglas del Sistema

* Contraseña mínima de 8 caracteres
* Correo único por usuario
* Calificación mínima aprobatoria: 70%
* Intentos ilimitados en evaluaciones
* Solo se guarda el último intento

##  Flujo Principal del Sistema

1. El usuario se registra o inicia sesión.
2. El sistema valida los datos ingresados.
3. El usuario accede al menú principal.
4. Selecciona un módulo (alfabeto, palabras o frases).
5. Visualiza el contenido educativo.
6. Realiza una evaluación.
7. El sistema valida que todas las preguntas estén respondidas.
8. Se muestran los resultados con retroalimentación.
9. El sistema guarda el progreso del usuario.
10. El usuario puede continuar o cerrar sesión.

##  Equipo de Desarrollo

- Blanca → Coordinador  
- Dannia → Analista  
- Renata → Desarrollador  
- Valeria → Diseñador  
- Leticia → Tester
 
## Estado del Sistema
El sistema se encuentra en fase de desarrollo, con funcionalidades principales implementadas y en proceso de mejora continua.
