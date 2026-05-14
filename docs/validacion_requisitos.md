Validación de Requisitos Proyecto Zigna
Fecha: 14 de mayo de 2026
Responsable: Equipo de Desarrollo (Rama: feature-diseno diseñador)
Estado General: ✅ VALIDADO

## Validación de Requisitos (RNF)

### 1. Requisitos No Funcionales (RNF)
| ID | Requisito | Estado | Evidencia de Validación |
| :--- | :--- | :--- | :--- |
| **RNF-01** | Seguridad de Contraseñas | ✅ | Implementación de **bcrypt** para evitar texto plano. |
| **RNF-02** | Protección Inyección SQL | ✅ | Uso de **Prepared Statements** en `db.php` y `g_puntaje.php`. |
| **RNF-03** | Diseño Responsive | ✅ | Adaptación visual desde 360px hasta 1920px mediante CSS. |
| **RNF-04** | Tiempo de Respuesta | ✅ | Optimización de carga en módulos de dactilología. |
| **RNF-05** | Disponibilidad | ✅ | Verificado en entorno local XAMPP sin caídas. |
| **RNF-06** | Protección de Datos | ✅ | Planificación de protocolo HTTPS para despliegue final. |

---

### 2. Validación de Formularios y Errores
| Formulario | Validación Realizada | Estado |
| :--- | :--- | :--- |
| **Registro** | Bloqueo de campos vacíos y formato de correo electrónico. | ✅ |
| **Login** | Validación de credenciales seguras contra base de datos. | ✅ |
| **Evaluación** | Control de respuestas obligatorias antes del envío. | ✅ |
| **Errores** | Mensajes claros y resaltado visual en rojo (UX). | ✅ |

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
