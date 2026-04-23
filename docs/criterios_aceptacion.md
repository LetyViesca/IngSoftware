# Criterios de aceptación

En este documento se definen los criterios de aceptación para cada requisito funcional del sistema ZIGNA.

---

## RF-01: Registro de usuario

- El sistema permite registrar un usuario con nombre, correo electrónico y contraseña.
- El sistema valida que no existan campos vacíos antes de cualquier otra validación.
- El sistema valida que el correo tenga un formato correcto antes de procesar el registro.
- El correo electrónico debe ser único.
- La contraseña debe tener mínimo 8 caracteres.
- El sistema resalta en color rojo los campos obligatorios que estén vacíos.
- El sistema muestra mensajes de error cuando los datos son inválidos.
- El sistema muestra un mensaje de éxito al completar el registro correctamente.
- Las contraseñas se almacenan cifradas mediante bcrypt.
- No se requiere verificación por correo electrónico.

---

## RF-02: Inicio de sesión

- El sistema permite iniciar sesión con correo y contraseña.
- El sistema valida que no existan campos vacíos antes de consultar la base de datos.
- El sistema valida el formato del correo antes de consultar la base de datos.
- El sistema consulta la base de datos solo si las validaciones previas son correctas.
- El sistema muestra mensaje de error si las credenciales son incorrectas.
- El sistema resalta en color rojo los campos vacíos.
- El sistema mantiene la sesión activa durante toda la navegación.
- El usuario puede navegar entre módulos sin que la sesión se cierre.
- Permite intentos ilimitados.
- No bloquea la cuenta tras múltiples intentos fallidos.

---

## RF-03: Alfabeto en LSM

- El sistema muestra todas las letras del alfabeto en LSM.
- Cada letra se presenta mediante una imagen individual.
- Cada imagen incluye una descripción textual correcta.
- Las imágenes se adaptan correctamente a diferentes tamaños de pantalla.
- Si una imagen no carga, el sistema continúa funcionando sin bloquearse.
- El usuario puede regresar al menú de módulos sin perder la sesión.
- No incluye animaciones ni videos.

---

## RF-04: Palabras básicas

- El sistema muestra palabras organizadas en las categorías:
  - Saludos
  - Familia
  - Números
  - Colores
- Cada palabra incluye una imagen representativa.
- Cada palabra incluye una descripción textual correcta.
- Las imágenes se adaptan correctamente a la pantalla.
- Si una imagen no carga, el sistema no se bloquea.
- El usuario puede regresar al menú principal sin perder la sesión.

---

## RF-05: Frases comunes

- El sistema muestra al menos 10 frases comunes.
- Cada frase incluye una imagen representativa.
- Cada frase incluye una explicación escrita breve.
- Las imágenes se adaptan correctamente a la pantalla.
- El usuario puede regresar al menú principal sin perder la sesión.

---

## RF-06: Evaluaciones

- El sistema incluye evaluaciones con 5 a 10 preguntas.
- Cada pregunta tiene 4 opciones de respuesta.
- Solo una opción puede ser seleccionada por pregunta.
- El orden de las preguntas es fijo.
- El sistema verifica que no exista ninguna pregunta sin responder antes de permitir el envío.
- Si existen preguntas sin responder, el sistema las resalta visualmente.
- El usuario puede realizar intentos ilimitados.
- Si el usuario abandona la evaluación, esta se invalida y no se guarda.

---

## RF-07: Retroalimentación

- El sistema muestra los resultados únicamente al finalizar la evaluación.
- El sistema indica visualmente las respuestas correctas en color verde.
- El sistema indica visualmente las respuestas incorrectas en color rojo.
- En caso de error, el sistema muestra cuál era la respuesta correcta.
- El sistema presenta el puntaje final obtenido.

---

## RF-08: Progreso

- El sistema almacena las lecciones completadas.
- El sistema guarda únicamente el último puntaje obtenido por evaluación.
- No se almacenan intentos anteriores.
- El sistema registra la fecha del último acceso.
- La calificación mínima aprobatoria es del 70%.
- Un módulo se marca como completado al alcanzar al menos el 70%.
- Al completar un módulo, su estado visual cambia inmediatamente (ej. check verde).
- El progreso del usuario se actualiza automáticamente sin necesidad de recargar la página.