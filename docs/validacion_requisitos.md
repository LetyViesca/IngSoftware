Validación de Requisitos Proyecto Zigna
Fecha: 14 de mayo de 2026
Responsable: Equipo de Desarrollo (Rama: feature-diseno diseñador)
Estado General: ✅ VALIDADO

1. Validación de Requisitos No Funcionales (RNF)
ID	Requisito	Estado	Observaciones de Validación
RNF-01	Seguridad de Contraseñas	✅	Se confirmó la migración de texto plano a cifrado mediante bcrypt en el archivo procesar_registro.php.
RNF-02	Protección Inyección SQL	✅	Se validó la implementación de Prepared Statements en todos los módulos de backend (db.php, g_puntaje.php).
RNF-03	Diseño Responsive	✅	El archivo styles.css incluye Media Queries que cubren desde 360px hasta 1920px.
RNF-04	Tiempo de Respuesta	✅	Pruebas locales en XAMPP muestran tiempos de carga menores a 2 segundos en módulos de LSM.
RNF-05	Disponibilidad	✅	El sistema es estable en entorno local; preparado para migración a servidor productivo.
RNF-06	Protección de Datos	✅	Se tiene la hoja de ruta para la implementación de certificados SSL/HTTPS en el despliegue final.
________________________________________
2. Auditoría de Formularios
A. Registro e Inicio de Sesión
•	Validación de Campos: Se verificó que los archivos registro.php y login.php bloquean envíos con campos vacíos.
•	Formato: El campo de correo electrónico utiliza filter_var() en PHP para asegurar un formato válido.
•	Seguridad: La contraseña cumple con la longitud mínima de 8 caracteres y validación contra base de datos mediante password_verify().
B. Módulo de Evaluación (LSM)
•	Integridad: El formulario de evaluación (abecedario, frases y palabras) no permite el envío si existen preguntas sin responder.
•	Interfaz: Se implementó el resaltado visual en rojo para errores, mejorando la experiencia del usuario (UX).

3. Control de Errores y Seguridad
•	Manejo de Excepciones: Los mensajes de error ahora son claros y no exponen información sensible de la base de datos MySQL (como nombres de tablas o columnas).
•	Sanitización: Todas las entradas del usuario son tratadas como texto antes de procesarse, eliminando riesgos de scripts maliciosos.
4. Conclusión Técnica
Tras la separación de diseño y lógica del código, la mejoría del código (procesos sin terminar) del Sprint3 y con la implementación de los RNF de este proyecto y la verificación de cada uno de ellos, el sistema cumple satisfactoriamente con los criterios de seguridad y funcionalidad establecidos en la documentación del proyecto.
