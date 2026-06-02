# Nota Técnica de Implementación — Sprint 5

**Proyecto:** Zigna — Plataforma de Aprendizaje de LSM
**Rol:** Dev Líder
**Rama:** feature-dev
**Fecha:** 01 de junio de 2026

---

## 1. Contexto de la mejora

### Retroalimentación externa (docente externo)
Durante la revisión externa se identificaron dos observaciones:

1. Seguridad — Navegación por URL: Era posible acceder directamente
   a carpetas del servidor mediante la URL, exponiendo la estructura
   del proyecto y permitiendo la descarga de archivos sensibles.

2. Usabilidad — Fin de evaluación: Al terminar una evaluación, la
   pantalla permanecía en la última pregunta sin redirigir al usuario.
   La docente no encontró los botones de acción hasta que el equipo
   le indicó que debía subir manualmente. Se identificó como pérdida
   de flujo.

### Mejora obligatoria (docente de la materia)
La docente titular solicitó implementar una ruta de aprendizaje
estructurada con las siguientes mejoras:

- Desbloqueo progresivo de módulos
- Evaluaciones dinámicas con preguntas aleatorias
- Aleatorización del orden de respuestas
- Indicadores visuales de progreso e insignias

---

## 2. Soluciones implementadas

### Seguridad — Deshabilitación de listado de directorios
Archivo: public/.htaccess
Se configuró Options -Indexes para impedir navegación por URL
entre carpetas del servidor.

### Usabilidad — Scroll automático al finalizar evaluación
Al confirmar el resultado, el sistema redirige automáticamente
al inicio de la página exponiendo los botones de acción.
Archivos: evaluacion.js, evaluacionPalabras.js, evaluacionFrase.js

### Desbloqueo progresivo de módulos
Módulo completado = puntaje >= 80. Orden: Abecedario → Palabras → Frases.
Módulos bloqueados muestran overlay y bloquean acceso por URL.
Archivos: inicio.php, M_abecedario.php, M_palabras.php, M_frases.php,
modulos.css

### Evaluaciones dinámicas
Tabla Pregunta creada. Endpoint get_preguntas.php devuelve 10
preguntas aleatorias por módulo.
SELECT * FROM Pregunta WHERE id_Modulo = ? ORDER BY RAND() LIMIT 10

### Aleatorización de respuestas
Fisher-Yates shuffle en los tres JS de evaluación.
Validación siempre por valor, nunca por posición.

### Progreso e insignias
Vista de progreso con estado real, barra proporcional, historial
de 3 intentos, badge por módulo y banner al completar el curso.
Tabla Historial_evaluacion creada para registro acumulativo.

---

## 3. Archivos modificados y creados

| Archivo | Acción | Cambio |
|---|---|---|
| public/.htaccess | Modificado | Options -Indexes |
| app/views/inicio.php | Modificado | Desbloqueo + badges |
| app/views/M_abecedario.php | Modificado | Verificación acceso |
| app/views/M_palabras.php | Modificado | Verificación acceso |
| app/views/M_frases.php | Modificado | Verificación acceso |
| app/views/evaluacion.php | Modificado | Preguntas dinámicas |
| app/views/evaluacionPalabras.php | Modificado | Preguntas dinámicas |
| app/views/evaluacionFrases.php | Modificado | Preguntas dinámicas |
| app/views/progreso.php | Modificado | Historial e insignias |
| app/controllers/g_puntaje.php | Modificado | Historial + fix bind_param |
| app/controllers/get_preguntas.php | Creado | Endpoint preguntas |
| public/assets/js/evaluacion.js | Modificado | Shuffle + scroll |
| public/assets/js/evaluacionPalabras.js | Modificado | Shuffle + scroll |
| public/assets/js/evaluacionFrase.js | Modificado | Shuffle + scroll |
| public/assets/js/navbar-dropdown.js | Creado | Toggle dropdown móvil |
| public/assets/css/modulos.css | Modificado | Badges y overlay |
| public/assets/css/progreso.css | Modificado | Historial e insignias |
| database/database.sql | Modificado | Tablas |

## 4. Cambios en base de datos

| Tabla | Acción | Descripción |
|---|---|---|
| Pregunta | CREATE + INSERT | Banco de preguntas 3 módulos |
| Historial_evaluacion | CREATE | Registro acumulativo de intentos |

---

## 5. Riesgos identificados y mitigados

| Riesgo | Mitigación |
|---|---|
| Listado de directorios expuesto | Options -Indexes en .htaccess |
| Parse error en inicio.php tras merge | Detectado y corregido |
| bind_param incorrecto | Corregido de "iis" a "iii" |
| Módulos 2 y 3 sin preguntas | Detectado en prueba y corregido |

---

## 6. Decisiones técnicas

- Se mantuvo Resultado_evaluacion con UNIQUE constraint original
  para preservar lógica de desbloqueo.
- Se creó Historial_evaluacion como tabla separada para no alterar
  el esquema existente.
- Scroll automático implementado en JS con window.scrollTo para
  no modificar lógica PHP de guardado.
- Dropdown móvil migrado de :focus-within CSS a toggle JS por
  incompatibilidad con dispositivos táctiles.

---

## 7. Preparación para clonación externa

1. Clonar repositorio en htdocs/ZIGNA
2. Importar database/database.sql en MySQL Workbench
3. Verificar credenciales en app/config/db.php
4. Acceder a localhost/ZIGNA/public

---

## 8. Estado de liberación

Sistema integrado en feature-dev con todos los cambios del Sprint 5.
Pendiente: merge a desarrollo y PR final a main con dictamen favorable.