# Análisis de Impacto de la Mejora

## Proyecto
**ZIGNA – Plataforma de Aprendizaje de Lengua de Señas Mexicana**

## Mejora Analizada

Implementar una mejora en la navegación del sistema mediante la redirección automática al finalizar evaluaciones, incorporación de accesos visibles hacia módulos y progreso, inclusión de una introducción informativa en la pantalla principal y fortalecimiento básico de la seguridad mediante revisión de accesos por URL.

---

## 1. ¿Qué parte del sistema se modificará?

Se modificarán las pantallas de inicio, evaluación y progreso. También se realizarán ajustes en la lógica de navegación y en la gestión de accesos mediante URL.

---

## 2. ¿Qué requisito se fortalece o ajusta?

### Requisitos funcionales

- Navegación entre módulos y evaluaciones.
- Visualización del progreso del usuario.
- Finalización de evaluaciones.

### Requisitos no funcionales

- Usabilidad.
- Experiencia de usuario.
- Seguridad básica del sistema.

---

## 3. ¿Qué pantalla se verá afectada?

- Inicio.
- Evaluación.
- Progreso.
- Menú principal.

---

## 4. ¿Qué lógica o proceso se ajustará?

Se modificará el flujo posterior a la finalización de evaluaciones para redirigir automáticamente al usuario hacia una pantalla relevante. También se agregarán elementos visuales para facilitar la navegación y comprensión del sistema.

---

## 5. ¿La base de datos requiere cambio?

**No.**

La mejora propuesta no requiere modificaciones en la estructura de la base de datos ni en las relaciones existentes.

---

## 6. ¿Se necesita agregar, modificar o consultar información?

**Sí.**

Se agregará contenido informativo en la pantalla principal relacionado con el propósito del sistema y el contexto de la Lengua de Señas Mexicanas.

---

## 7. ¿Qué riesgo técnico existe?

- Errores en la redirección automática.
- Pérdida de navegación entre módulos.
- Enlaces incorrectos.
- Problemas de compatibilidad visual en dispositivos móviles.
- Accesos indebidos mediante URL si la validación no se implementa correctamente.

---

## 8. ¿Qué pruebas deberá realizar QA?

- Verificar la redirección correcta después de finalizar evaluaciones.
- Comprobar el acceso correcto a módulos y progreso.
- Validar el funcionamiento de enlaces y botones.
- Revisar el comportamiento responsive en dispositivos móviles.
- Verificar que las rutas protegidas no sean accesibles sin autorización.
- Confirmar que el contenido informativo se visualice correctamente.

---

## 9. ¿Qué puede romperse si el cambio se implementa mal?

- Flujo de navegación del usuario.
- Acceso a módulos educativos.
- Registro de progreso.
- Visualización de resultados.
- Compatibilidad en dispositivos móviles.

---

## 10. ¿Cómo se comprobará que la mejora sí quedó implementada?

Se realizará una prueba funcional completa donde el usuario:

1. Inicie sesión.
2. Acceda a un módulo.
3. Complete una evaluación.
4. Sea redirigido automáticamente.
5. Consulte su progreso.
6. Navegue entre las distintas secciones sin errores.

Además, se verificará la correcta visualización de la introducción informativa y el funcionamiento de los elementos visuales agregados.

---

# Tabla de Impacto

| Área afectada | Impacto identificado.                                | Acción requerida |
|---------------|------------------------------------------------------|------------------|
| Requisitos    | Se fortalecen requisitos de navegación y usabilidad. | Actualizar documentación de requisitos. |
| Interfaz      | Se agregarán elementos informativos y visuales.      | Modificar vistas y estilos CSS. |
| Lógica.       | Cambia el flujo posterior a las evaluaciones.        | Actualizar lógica de navegación y redirecciones. |
| Base de datos | No se identifican cambios necesarios.                | Sin acción requerida. |
| Pruebas.      | Nuevos escenarios funcionales y de navegación.       | Ejecutar pruebas QA y registrar evidencias. |
| Documentación | Deben actualizarse los documentos del Sprint.        | Actualizar README y documentación de mejoras. |

---

## Conclusión

El análisis de impacto indica que las mejoras propuestas son técnicamente viables y presentan un riesgo bajo a medio para el sistema. La implementación fortalecerá la experiencia de usuario, la navegación y la percepción general de calidad del proyecto, sin requerir cambios estructurales en la base de datos.