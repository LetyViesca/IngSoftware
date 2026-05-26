# estructura_repositorio
He diseñado la arquitectura de este repositorio basándome en el estándar Slim-Skeleton v4, optimizándola para gestionar de manera eficiente el catálogo de señas y la interacción con la base de datos MySQL.

1. Justificación Técnica de la Arquitectura
Hemos seleccionado esta estructura no solo como referencia, sino por su capacidad para resolver necesidades críticas de nuestro proyecto:

Protección de Activos: Al usar public/ como raíz, blindamos el acceso directo a nuestra lógica de negocio y archivos de configuración, permitiendo que solo los recursos visuales (señas) y el punto de entrada sean visibles al navegador.

Gestión de Catálogo Visual: Dado que el núcleo del proyecto son las imágenes, esta estructura permite separar el almacenamiento físico de las fotos en assets/img/ de la lógica que las consulta, evitando cuellos de botella en la carga.

Independencia de Roles: El equipo de diseño puede trabajar en las views/ de las lecciones mientras el equipo de desarrollo actualiza los Models/ para las nuevas consultas de señas en MySQL sin generar conflictos de código.

2. Organización Detallada del Proyecto
A diferencia de un esqueleto genérico, nuestro repositorio se organiza así para cumplir con las lecciones de lenguaje de señas:

public/assets/img/: Contiene el repositorio de imágenes organizado por subcarpetas: /abecedario, /frases_comunes y /gramatica. Esto facilita la indexación de las rutas en la base de datos.

src/Models/: Aquí residen las clases encargadas de interactuar con la tabla senas en MySQL. Su función es devolver la ruta exacta de la imagen solicitada por el usuario.

src/Controllers/: Gestiona las peticiones de búsqueda. Si un usuario busca "Hola", el controlador valida la entrada y solicita al modelo la imagen correspondiente.

views/: Plantillas dinámicas que muestran las galerías de señas y las interfaces de evaluación para el alumno.

3. Estándares de Colaboración y Calidad (Git Flow)
Para mantener la integridad del código, se establecen las siguientes reglas de contribución:

Ramas de Rol (feature-diseno, feature-dev, feature-analista): Ramas aisladas para tareas específicas. Ningún desarrollador tiene permitido subir cambios directamente a las ramas de integración.

Pull Requests (PR): Cada mejora o nueva funcionalidad (ej: nuevas imágenes de señas) debe pasar por un proceso de revisión y aprobación por QA antes de integrarse a la rama desarrollo.

Rama main: Reservada exclusivamente para versiones probadas y estables que contienen el curso de lenguaje de señas funcional.
