# Reporte de Pruebas

**Proyecto:** Plataforma Educativa - Pagina de Aprendizaje LSM
**Estado General:**  **FALLIDO** (Debido a defecto crítico en persistencia de datos)

## 1. Detalle de Casos de Prueba

### CP-01: Registro de nuevo usuario
- **Precondición:** El usuario no debe tener una cuenta existente con el mismo correo.
- **Entradas:** `Nombre`, `Apellido Paterno`, `Apellido Materno`, `Correo`, `Contraseña`.
- **Pasos:** 1. Llenar el formulario con datos válidos.
    2. Hacer clic en el botón "Registrar".
- **Resultado Esperado:** Creación exitosa del registro en base de datos y redirección al Dashboard.
- **Resultado Obtenido:** El sistema registra correctamente al usuario.
- **Estado:**  **CORRECTO**

### CP-02: Inicio de sesión (Login)
- **Precondición:** El usuario debe estar previamente registrado (CP-01).
- **Entradas:** `Correo`, `Contraseña`.
- **Resultado Esperado:** Autenticación exitosa y generación de token de sesión.
- **Resultado Obtenido:** El sistema permite el acceso correctamente.
- **Estado:**  **CORRECTO**

### CP-03: Interacción con módulos de contenido
- **Descripción:** Navegación por los módulos de Abecedario, Frases y Palabras.
- **Acción:** Seleccionar cada módulo y verificar la carga de elementos.
- **Resultado Esperado:** Los activos (imágenes/texto) cargan sin errores y la navegación es fluida.
- **Resultado Obtenido:** El usuario interactúa y visualiza contenidos correctamente.
- **Estado:**  **CORRECTO**

### CP-04: Persistencia de datos (Guardar progreso)
- **ID de Defecto:** BUG-001
- **Severidad:** **CRÍTICA**
- **Descripción:** Verificación de que el avance del usuario se almacena tras completar una actividad.
- **Pasos:** 1. Realizar una actividad dentro de un módulo.
- **Resultado Esperado:** El sistema debe mostrar el progreso alcanzado anteriormente.
- **Resultado Obtenido:** El progreso no logra guardarse en base de datos.
- **Estado:**  **INCORRECTO**

### CP-05: Sistema de Retroalimentación (Feedback)
- **Acción:** Realizar acciones correctas e incorrectas dentro de los ejercicios.
- **Resultado Esperado:** El sistema muestra mensajes visuales/auditivos de éxito o error según el desempeño.
- **Resultado Obtenido:** Feedback visual mostrado correctamente.
- **Estado:**  **CORRECTO**

### CP-06: Ejecución de Evaluación
- **Acción:** Acceder al módulo de evaluación y responder los reactivos.
- **Resultado Esperado:** El flujo de examen permite avanzar entre preguntas y finalizar el proceso.
- **Resultado Obtenido:** El sistema permite completar la evaluación sin errores.
- **Estado:**  **CORRECTO**

### CP-07: Cierre de sesión (Logout)
- **Acción:** Hacer clic en "Cerrar Sesión".
- **Resultado Esperado:** Destrucción de la sesión en el servidor y redirección a la pantalla de Login.
- **Resultado Obtenido:** Sesión finalizada correctamente.
- **Estado:**  **CORRECTO**
