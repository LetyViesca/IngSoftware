# REPORTE DE PRUEBAS – ZIGNA

## Sprint 4 – QA, Validaciones y Corrección de Errores

---

# 1. Información General

| Campo | Información |
|---|---|
| **Proyecto** | ZIGNA |
| **Tipo de sistema** | Plataforma web de aprendizaje de Lengua de Señas Mexicana |
| **Sprint evaluado** | Sprint 4 |
| **Responsable QA** | Renata Monserrath Flores Ramírez |
| **Fecha de entrega** | 13 de mayo de 2026 |
| **Entorno de pruebas** | XAMPP, PHP, MySQL, HTML, CSS, JavaScript |
| **Repositorio** | GitHub – IngSoftware |

---

# 2. Objetivo de las pruebas

Verificar el correcto funcionamiento de las funcionalidades principales del sistema ZIGNA mediante pruebas funcionales, validaciones de formularios, pruebas de navegación y pruebas de manejo de errores, con el propósito de garantizar la estabilidad, seguridad y usabilidad del sistema antes de su integración final.

---

# 3. Alcance de las pruebas

Las pruebas realizadas durante el Sprint 4 abarcan los siguientes módulos y funcionalidades:

- Registro de usuarios
- Inicio y cierre de sesión
- Navegación entre módulos
- Evaluaciones interactivas
- Guardado y actualización de progreso
- Validaciones de formularios
- Manejo de errores
- Conexión y consultas a base de datos
- Diseño responsive
- Seguridad básica contra inyección SQL

---

# 4. Casos de prueba exitosos

| ID | Caso de prueba | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| CP-01 | Registro de usuario válido          | Registrar correctamente al usuario  | Usuario registrado exitosamente             | Exitoso |
| CP-02 | Inicio de sesión válido             | Permitir acceso al sistema          | Acceso concedido correctamente              | Exitoso |
| CP-03 | Navegación entre módulos            | Cambiar correctamente entre páginas | Navegación funcional                        | Exitoso |
| CP-04 | Realización de evaluaciones         | Mostrar resultados y puntaje        | Resultados mostrados correctamente          | Exitoso |
| CP-05 | Visualización de módulos educativos | Mostrar contenido multimedia y textual | Contenido visible correctamente          | Exitoso |
| CP-06 | Guardado de progreso                | Almacenar progreso del usuario      | Datos guardados correctamente en MySQL      | Exitoso |
| CP-07 | Actualización de evaluación         | Sobrescribir resultados anteriores  | Última evaluación actualizada correctamente | Exitoso |

---

# 5. Pruebas de validación y estrés

| ID | Prueba realizada | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| ST-01 | Campos vacíos en login               | Mostrar mensaje de error      | Validación aplicada correctamente               | Exitoso |
| ST-02 | Correo inválido                      | Bloquear registro/login       | Mensaje mostrado correctamente                  | Exitoso |
| ST-03 | Contraseña incorrecta                | Denegar acceso                | Error controlado correctamente                  | Exitoso |
| ST-04 | Intento básico de inyección SQL      | Bloquear consulta maliciosa   | Consulta protegida mediante Prepared Statements | Exitoso |
| ST-05 | Evaluación incompleta                | Impedir envío del formulario  | Validación aplicada correctamente               | Exitoso |
| ST-06 | Caracteres especiales en formularios | Evitar fallos del sistema     | Sistema respondió correctamente                 | Exitoso |
| ST-07 | Contraseña menor a 8 caracteres      | Bloquear registro             | Restricción aplicada correctamente              | Exitoso |
| ST-08 | Correo duplicado                     | Evitar duplicidad de usuarios | Validación aplicada correctamente               | Exitoso |

---

# 6. Errores encontrados y corregidos

| ID | Error detectado | Severidad | Estado |
|---|---|---|---|
| ER-01 | El progreso del usuario no se almacenaba correctamente  | Alta  | Corregido |
| ER-02 | Las evaluaciones no actualizaban resultados posteriores | Alta  | Corregido |
| ER-03 | Las respuestas de evaluaciones permanecían estáticas    | Media | Corregido |
| ER-04 | Falta de validaciones en formularios                    | Alta  | Corregido |
| ER-05 | Problemas de organización y rutas de archivos           | Media | Corregido |
| ER-06 | Mensajes de error poco comprensibles para el usuario    | Media | Corregido |
| ER-07 | Problemas de responsive design en móviles               | Media | Corregido |
| ER-08 | Desbordamiento visual en evaluaciones móviles           | Media | Corregido |

---

# 7. Evidencias

## Evidencias visuales y documentación

- Registro exitoso de usuarios
- Inicio de sesión funcional
- Validaciones de formularios
- Resultados de evaluaciones
- Guardado de progreso
- Errores detectados y corregidos
- Evidencias responsive en dispositivos móviles
- Cambios realizados en estructura del proyecto

## Repositorio de evidencias

### Correcciones y resultados QA

```txt
https://github.com/LetyViesca/IngSoftware/tree/d59bba553471ecdfcdf0ca1b50e195c71d8b546e/Imagenes_Sprint4/Correcciones-Resultados_Qa
```

### Evidencia de errores detectados

```txt
https://github.com/LetyViesca/IngSoftware/tree/d59bba553471ecdfcdf0ca1b50e195c71d8b546e/Imagenes_Sprint4/Errores_Qa
```

---

# 8. Conclusiones

Durante el Sprint 4 se realizaron pruebas funcionales y de validación sobre los módulos principales del sistema ZIGNA, identificando y corrigiendo errores relacionados con almacenamiento de progreso, validaciones de formularios, evaluaciones y diseño responsive.

Las mejoras implementadas permitieron incrementar la estabilidad del sistema, fortalecer la seguridad básica mediante consultas preparadas (*Prepared Statements*) y mejorar significativamente la experiencia visual y de navegación tanto en dispositivos móviles como de escritorio.

Actualmente, las funcionalidades principales del sistema operan de manera correcta y estable, cumpliendo con los requisitos establecidos para el sprint evaluado.
