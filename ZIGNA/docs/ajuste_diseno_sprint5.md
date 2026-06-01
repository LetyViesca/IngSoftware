# Reporte de Ajuste de Diseño — Sprint 5

**Responsabilidad Principal Aplicada:** Ajustar la interfaz o flujo visual afectado por la mejora externa, manteniendo estricta coherencia con el diseño previo del sistema ZIGNA.

---

## Introducción y Contexto del Sprint
El presente documento constituye el entregable reglamentario del rol de **Diseñador** para el Sprint 5. El trabajo se dividió estratégicamente en dos fases críticas: primero, la resolución de tareas rezagadas y optimizaciones internas de diseño (Fase Pre-Evaluación) para asegurar la estabilidad visual; segundo, el procesamiento y la implementación de los ajustes derivados de la **Evaluación Externa** (Fase Post-Evaluación) para maximizar la usabilidad del sistema interactivo de Lengua de Señas Mexicana (LSM).

---

## Desglose Técnico de Modificaciones Visuales y de Flujo
A continuación, se dejan asentadas todas las intervenciones de diseño técnico e interfaz realizadas sobre la plataforma ZIGNA durante este periodo, ordenadas por fases cronológicas dentro del ciclo de desarrollo:

### Fase A: Mejoras y Correcciones Internas (Previas a la Evaluación Externa)

* **Pantalla de Registro (Optimización de Flujo):** Se detectó que el cambio brusco e instantáneo de interfaz al finalizar el flujo de registro generaba desorientación severa en el usuario final, sumado a que los mensajes de error desalineados rompían la armonía de la retícula. Para solucionarlo, se implementó una ventana emergente (pop-up) elegante con efecto de fondo difuminado (`backdrop-filter: blur`), y se reacomodaron geométricamente los microtextos de error para mantener la limpieza formal del layout.
 
* **Evaluación de Palabras (Corrección de Interfaz):** Se solucionó un problema visual de renderizado eliminando por completo una barra morada vacía que aparecía por error justo debajo del contador de preguntas en el CSS. Paralelamente, se reactivó y suavizó el estado interactivo (*hover*) en las tarjetas de preguntas, permitiendo que ahora se elevate en el eje Y y apliquen sombras paralelas sutiles cuando el usuario pasa el cursor.
 
* **Módulo de Frases (Rediseño Estructural):** Las longitudes variables de las frases generaban una asimetría crítica y desorden visual, provocando espacios en blanco indeseados y componentes huérfanos al final de la vista. Se aplicó un rediseño completo de la retícula de distribución, forzando un esquema estricto de filas fijas en 2 columnas, homogeneizando el tamaño y altura de todos los contenedores de texto.
 
* **Módulo de Abecedario (Consistencia Semántica):** Se identificó la inclusión errónea del término 'Dactilología' dentro de múltiples módulos generales de la aplicación, lo cual diluía la claridad conceptual. Se procedió a restringir categóricamente la nomenclatura, eliminándola de flujos externos y concentrándola en exclusiva en la sección del abecedario, por estricta coherencia pedagógica con el deletreo manual en LSM.

* **Cabeceras de Acceso (Alineación e Identidad Visual):** Existía una ligera asimetría en la ubicación del logotipo corporativo de ZIGNA en los accesos de la plataforma. Se corrigieron los márgenes internos y externos logrando un centrado absoluto del isotipo tanto en la pantalla de Login como en la de Registro, garantizando cabeceras simétricas y uniformes.

---

### Fase B: Ajustes Implementados por Resultados de la Evaluación Externa

* **Pantalla de Inicio y Módulos de Contenido (Feedback Activo):** El evaluador externo señaló una falta de feedback visual interactivo en el menú principal. Ante esto, se incorporó una micro-interacción de escala (zoom suave de 1.05x) y un cambio controlado de opacidad al posicionar el cursor sobre las imágenes de las portadas de los módulos (Abecedario, Palabras, Frases) y sus respectivas secciones de evaluación.

* **Botón de Módulo en Abecedario (Homologación Cromática):** Se detectó un hallazgo de inconsistencia en el botón de arranque de la evaluación del abecedario, el cual utilizaba una paleta cromática ajena al sistema de diseño unificado. Se sustituyeron los valores hexadecimales para aplicar los colores primarios institucionales, unificando este componente con el resto de llamadas a la acción (CTAs).

* **Pantallas de Evaluación General (Persistencia de Navegación):** Se identificó que el menú global y la opción esencial de 'Cerrar Sesión' desaparecían del layout mientras el usuario resolvía activamente una prueba. Se reestructuró la barra de navegación (Navbar) para forzar la persistencia del disparador de salida segura en todas las pantallas de evaluación de la página.

* **Introducción en Inicio (Rediseño de Copia Informativa):** El texto introductorio de bienvenida resultaba plano, vago y poco descriptivo sobre el propósito de ZIGNA. Se redactó y maquetó una nueva introducción enriquecida, aplicando jerarquía tipográfica y orientando el mensaje directamente hacia los objetivos educativos y de inclusión en el aprendizaje LSM.

* **Flujo Final de Evaluación (Optimización de Usabilidad y Scroll):** Se corrigió un problema crítico de usabilidad detectado en las pruebas externas: al finalizar una evaluación y pulsar 'Aceptar', el sistema mantenía la ventana estática en el margen inferior de la pantalla (*scroll bottom*), ocultando los pasos siguientes. Se inyectó un comportamiento automático de scroll hacia el inicio de la página (`window.scrollTo({top: 0, behavior: 'smooth'})`), exponiendo inmediatamente al usuario los botones de 'Ver Progreso' o 'Volver al Módulo'.
 
* **Consistencia de Assets en Abecedario (Integración Gráfica):** Derivado del reporte externo, se detectó la ausencia del asset visual correspondiente a la letra 'Q' dentro del catálogo dinámico. Se diseñó, optimizó e integró la imagen faltante en su respectivo contenedor dentro del módulo del abecedario, completando el flujo completo de consulta del alfabeto LSM.
 
* **Estabilización del Menú Desplegable de Módulos (Diseño Responsivo):** Se detectó un problema crítico de usabilidad en dispositivos móviles donde la lista desplegable de módulos se cerraba de forma prematura antes de que el usuario pudiera seleccionar una opción, provocando además que los elementos de navegación se desalinearan y desplazaran bruscamente hacia abajo. Para solucionarlo, se modificó el archivo `navbar.css` reconfigurando el menú bajo un esquema de posicionamiento absoluto. Esto permite que el submenú flote limpiamente sobre la interfaz en pantallas menores a 900px sin empujar los bloques adyacentes. Asimismo, se recalibró el pseudo-elemento `::after` para actuar como un puente de contacto invisible continuo, asegurando que el estado *hover* permanezca activo, estable y responsivo durante todo el trayecto del cursor o pulsación táctil.
 
* **Consistencia de Texto en Botón de Inicio (Módulo Frases):** Con el objetivo de unificar los llamados a la acción dentro de las vistas de aprendizaje, se intervino el archivo `M_frases.php` localizado en la carpeta de vistas (`app/views/`). Se modificó la etiqueta de texto del botón de inicio de pruebas, reemplazando la inscripción original de "Evaluación" por el nuevo identificador requerido para el botón de comenzar evaluación. Este ajuste garantiza una línea de comunicación uniforme y una experiencia visual predecible para el usuario al momento de transicionar entre las lecciones teóricas y las secciones de evaluación interactiva.

---

## Relación con la Mejora Externa y Apoyo al Usuario Final
Todas las acciones ejecutadas durante este periodo de trabajo responden directamente a los criterios de calidad visual, consistencia e inclusión. Al incorporar el scroll automático superior al finalizar las pruebas, corregir las inconsistencias cromáticas de los botones y estabilizar por completo la barra de navegación responsiva, se redujo drásticamente la carga cognitiva del usuario. ZIGNA cuenta ahora con un ecosistema visual predecible, uniforme y fluido, alineado al 100% con los estándares exigidos por la evaluación de control externa.