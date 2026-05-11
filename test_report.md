# REPORTE DE PRUEBAS – ZIGNA

## Sprint 4 – QA y Validaciones

---

# 1. Información General

**Proyecto:** ZIGNA
**Módulo evaluado:** Sistema web de Lengua de Señas Mexicana
**Sprint:** Sprint 4
**Responsable QA:** Renata Flores
**Fecha de pruebas:** [Agregar fecha]

---

# 2. Objetivo de las pruebas

Verificar el correcto funcionamiento de las funcionalidades principales del sistema, validar el comportamiento ante entradas inválidas y documentar errores detectados durante el Sprint 4.

---

# 3. Alcance de las pruebas

Las pruebas realizadas abarcan:

* Registro de usuario
* Inicio de sesión
* Navegación entre módulos
* Evaluaciones
* Guardado de progreso
* Validaciones de formularios
* Conexión con base de datos
* Interfaz visual y navegación

---

# 4. Casos de prueba exitosos

| ID    | Caso de prueba             | Resultado esperado               | Resultado obtenido               | Estado    |
| ----- | -------------------------- | -------------------------------- | -------------------------------- | --------- |
| CP-01 | Registro de usuario válido | Usuario registrado correctamente | Registro exitoso                 | Exitoso |
| CP-02 | Inicio de sesión correcto  | Acceso al sistema                | Acceso permitido                 | Exitoso |
| CP-03 | Navegación entre módulos   | Cambio correcto entre páginas    | Navegación funcional             | Exitoso |
| CP-04 | Realizar evaluación        | Mostrar resultado final          | Resultado mostrado correctamente | Exitoso |
| CP-05 | Visualización de módulos   | Mostrar contenido educativo      | Contenido visible correctamente  | Exitoso |

---

# 5. Stress Tests / Pruebas de entradas inválidas

| ID    | Prueba realizada                 | Resultado esperado          | Resultado obtenido               | Estado |
| ----- | -------------------------------- | --------------------------- | -------------------------------- | ------ |
| ST-01 | Campos vacíos en login           | Mostrar mensaje de error    | Validación correcta              | Exitoso|
| ST-02 | Correo inválido                  | Bloquear acceso             | Validación correcta              | Exitoso|
| ST-03 | Contraseña incorrecta            | Mostrar error               | Error mostrado correctamente     | Exitoso|
| ST-04 | Inyección SQL básica             | Bloquear consulta maliciosa | Pendiente de validación completa | Pendiente|
| ST-05 | Enviar evaluación incompleta     | No permitir envío           | Validación parcial               | Pendiente|
| ST-06 | Introducir caracteres especiales | Evitar errores del sistema  | Sin fallos críticos              | Exitoso|

---

# 6. Errores encontrados y reportados

| ID    | Error detectado                        | Severidad | Estado                 |
| ----- | -------------------------------------- | --------- | ---------------------- |
| ER-01 | No guardaba progreso del usuario       | Alta      | Corregido              |
| ER-02 | Evaluaciones no almacenaban resultados | Alta      | Corregido              |
| ER-03 | Mezcla de lógica e interfaz            | Media     | Corregido              |
| ER-04 | Falta de validaciones en formularios   | Alta      | En proceso             |
| ER-05 | Problemas de organización de carpetas  | Media     | Corregido              |

---

# 7. Evidencias

Agregar capturas (Pendiente):

* Registro exitoso
* Inicio de sesión
* Validaciones de error
* Resultados de evaluación
* Errores detectados
* Cambios en estructura del proyecto
* Evidencia de pruebas realizadas

---

# 8. Conclusiones

El sistema presenta mejoras significativas respecto a sprints anteriores, especialmente en organización del proyecto, validaciones y estructura general. Las funcionalidades principales son parcialmente funcionales y se logró corregir diversos errores críticos relacionados con evaluaciones y almacenamiento de datos.

Sin embargo, aún existen áreas pendientes de mejora relacionadas con validaciones y seguridad.

Se recomienda continuar fortaleciendo las pruebas funcionales y no funcionales antes de considerar el sistema como estable para producción.
