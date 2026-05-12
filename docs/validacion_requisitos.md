## Validación de requisitos 
### RNF-01: Seguridad de Contraseñas
Evidencia:
- Actualmente no se observa cifrado de contraseñas en el sistema.
Pendiente:
- Implementar almacenamiento seguro con bcrypt.
- Evitar almacenamiento en texto plano.
### RNF-02: Protección contra Inyección SQL
Evidencia:
- No se evidencia uso de consultas preparadas en el sistema actual.
Pendiente:
- Implementar prepared statements en PHP.
- Validación del lado del servidor.
### RNF-03: Diseño Responsive
Evidencia:
- El sistema puede visualizarse en navegador.
- Uso básico de CSS.
Pendiente:
- Adaptación completa a diferentes resoluciones (360px – 1920px).
- Pruebas en múltiples dispositivos.
### RNF-04: Tiempo de Respuesta
Evidencia:
- No se han realizado pruebas de rendimiento.
Pendiente:
- Medir tiempos de carga.
- Optimizar recursos si es necesario.
### RNF-05: Disponibilidad
Evidencia:
- El sistema se ejecuta en entorno local.
Pendiente:
- Evaluar en entorno productivo.
### RNF-06: Protección de Datos
Evidencia:
- No se utiliza protocolo HTTPS en entorno local.
Pendiente:
- Implementar HTTPS en servidor real.

## Validación de Formularios

### Formulario: Registro de usuario
Campos:
- Nombre completo (obligatorio)
- Correo electrónico (obligatorio)
- Contraseña (obligatorio)
Validaciones:
- Ningún campo puede estar vacío
- El nombre debe contener solo texto
- El correo debe tener formato válido
- El correo debe ser único
- La contraseña debe tener mínimo 8 caracteres


### Formulario: Inicio de sesión
Campos:
- Correo electrónico (obligatorio)
- Contraseña (obligatorio)
Validaciones:
- No permitir campos vacíos
- Validar formato de correo
- Validar credenciales contra base de datos
- Mostrar error si son incorrectas
### Formulario: Evaluación
Campos:
- Respuestas a preguntas (obligatorio)
Validaciones:
- Todas las preguntas deben ser respondidas
- Solo una opción por pregunta
- Resaltar preguntas sin responder
- No permitir envío si hay campos vacíos
### Manejo de errores
- Mostrar mensajes claros al usuario
- Resaltar campos incorrectos en color rojo
- Evitar envío de formularios inválidos- Protección de datos sensibles.
