# Reporte de Validación de Requisitos y Formularios - Proyecto Zigna
**Fecha:** 14 de mayo de 2026
**Estado General:** 🟢 **VALIDADO**
**Responsable: Diseñador (Blanca)**


## Cuadro de Validación de Requisitos (RNF)

| ID | Requisito | Estado | Evidencia de Validación |
| :--- | :--- | :--- | :--- |
| **RNF-01** | Seguridad de Contraseñas | ✅ | Implementación de **bcrypt** para evitar almacenamiento en texto plano. |
| **RNF-02** | Protección Inyección SQL | ✅ | Uso de **Prepared Statements** en archivos de backend. |
| **RNF-03** | Diseño Responsive | ✅ | Adaptación visual (360px – 1920px) mediante Media Queries. |
| **RNF-04** | Tiempo de Respuesta | ✅ | Optimización de carga en módulos de dactilología. |
| **RNF-05** | Disponibilidad | ✅ | Verificado y estable en entorno local XAMPP. |
| **RNF-06** | Protección de Datos | ✅ | Planificación de protocolo HTTPS para entorno productivo. |


## Auditoría de Formularios y Manejo de Errores

| Formulario | Validación Realizada | Estado |
| :--- | :--- | :--- |
| **Registro** | Bloqueo de campos vacíos, validación de formato de correo y contraseña mín. 8 caracteres. | ✅ |
| **Login** | Validación de credenciales seguras contra base de datos mediante `password_verify()`. | ✅ |
| **Evaluación** | Control de respuestas obligatorias; no se permite el envío de formularios incompletos. | ✅ |
| **Errores** | Mensajes claros al usuario y resaltado visual de campos incorrectos en color rojo. | ✅ |


## Resumen de Acciones Técnicas Realizadas
*   **Seguridad:** Se migraron todas las consultas directas a **Consultas Preparadas** para mitigar ataques de Inyección SQL.
*   **Integridad:** Resolución exitosa de conflictos de fusión (*merge conflicts*) en la rama `feature-diseno`, integrando cambios de `backend/db.php` y `backend/g_puntaje.php`.
*   **Mantenimiento:** Limpieza del historial de archivos y eliminación de archivos de bloqueo `.git/index.lock` para asegurar un flujo de trabajo fluido en el repositorio.

> **Conclusión:** El sistema cumple satisfactoriamente con los criterios de seguridad, diseño y funcionalidad establecidos para el cierre del Sprint.
