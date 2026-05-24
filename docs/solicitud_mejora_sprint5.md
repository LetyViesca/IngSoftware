# Solicitud de Mejora – Sprint 5

## 1. Identificación del proyecto

**Proyecto:** ZIGNA  
**Equipo:** Chicas superpoderosas  
**Fecha de revisión externa:** 21 de mayo del 2026 
**Docente externo:** Niria Gonzalez Ortiz  

---

## 2. Observación y problema

### Observación externa

Durante la revisión funcional del sistema, el docente externo destacó que la plataforma presenta un diseño visual agradable y organizado. Sin embargo, mencionó que el sistema podría mejorar su funcionalidad y experiencia de usuario al finalizar las evaluaciones, ya que actualmente el usuario queda ubicado al final de la página y puede perderse sin saber cuál es el siguiente paso dentro del sistema.

Asimismo, recomendó agregar una breve introducción en la pantalla principal explicando el propósito de la plataforma y el contexto de la Lengua de Señas Mexicana.

También señaló posibles áreas de mejora relacionadas con seguridad básica y experiencia visual interactiva.

---

### Problema detectado

El flujo de navegación después de finalizar una evaluación no guía correctamente al usuario hacia el siguiente proceso del sistema, generando confusión y afectando la experiencia de uso.

Además, la pantalla principal no comunica claramente el objetivo social y educativo de la plataforma, limitando el contexto para nuevos usuarios.

Por otra parte, se detectó la posibilidad de acceder a rutas sensibles mediante modificación manual de URL, representando un posible riesgo básico de seguridad.

---

## 3. Definición de la mejora

### Mejora solicitada

- Agregar una introducción breve en la página principal explicando el propósito del sistema y el contexto de la Lengua de Señas Mexicana.
- Redirigir automáticamente al usuario después de finalizar una evaluación.
- Incorporar accesos visibles hacia módulos y progreso.
- Agregar efectos visuales interactivos (hover y zoom).
- Revisar accesos por URL y protección básica de directorios.

---

### Versión que se implementará

Se implementará una mejora de navegación y experiencia de usuario que incluirá:

- redirección automática al finalizar evaluaciones,
- botones visibles hacia progreso y módulos,
- introducción informativa en pantalla inicial,
- efectos visuales básicos para mejorar interacción,
- y revisión de accesos inseguros mediante URL.

---

## 4. Clasificación

La solicitud de mejora se clasifica dentro de las siguientes categorías:

- **Funcional:** debido a la mejora en el flujo de navegación después de finalizar evaluaciones.
- **Visual:** por la incorporación de efectos interactivos y mejoras de presentación en pantalla.
- **Usabilidad:** porque busca facilitar la orientación y experiencia del usuario dentro del sistema.
- **Seguridad básica:** debido a la revisión de accesos mediante URL y protección de directorios sensibles.

---

## 5. Requisito afectado y prioridad

| Requisito afectado                      | Tipo | Prioridad |
|---                                      |---   |---|
| Navegación entre módulos y evaluaciones | RF   | Alta |
| Visualización de progreso del usuario   | RF   | Alta |
| Usabilidad del sistema                  | RNF  | Alta |
| Experiencia visual e interacción        | RNF  | Media |
| Seguridad básica de acceso mediante URL | RNF  | Media |

---

## 6. Justificación y evidencia

### Justificación

Las mejoras propuestas son viables dentro de la arquitectura actual del sistema y representan cambios de baja a media complejidad técnica. Estas mejoras impactan directamente en la experiencia de usuario, navegación y percepción general del sistema, fortaleciendo tanto la funcionalidad como la claridad visual de la plataforma.

Asimismo, la revisión de accesos mediante URL permitirá fortalecer aspectos básicos de seguridad antes de futuras iteraciones del proyecto.

---

### Evidencia

- Retroalimentación obtenida durante revisión externa del sistema.
- Registro de observaciones realizadas por el docente.
- Capturas y documentación almacenadas en Trello y documentación del Sprint 5.