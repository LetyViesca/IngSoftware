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

##  Flujo principal del sistema

El sistema permite:

1. Registro de usuario con validaciones:
- Campos obligatorios
- Formato de correo
- Contraseña mínima de 8 caracteres
- Almacenamiento cifrado con bcrypt
2. Inicio de sesión:
- Validación de campos y formato
- Consulta a base de datos solo si los datos son correctos
- Manejo de errores
- Sesión activa durante la navegación
3. Acceso a módulos:
- Visualización de alfabeto, palabras y frases
- Uso de imágenes adaptables
4. Evaluaciones:
- 5 a 10 preguntas
- 4 opciones por pregunta
- Validación de respuestas completas
5. Resultados:
- Respuestas correctas (verde)
- Incorrectas (rojo)
- Puntaje final
6. Progreso:
- Guarda último puntaje
- Módulo completado con ≥ 70%
- Actualización automática

## Equipo y roles.

Renata Flores->Desarrollador.

Valeria García->Diseñador.

Dannia Hernández->Analista.

Blanca Ruiz->Coordinador.

Leticia Viesca->Tester.


## Estado del Proyecto: 

En desarrollo (Desarrollo del sistema).
