CREATE DATABASE zigna;
USE zigna;

-- Tabla Usuario
CREATE TABLE Usuario 
(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(45),
    apellido_paterno VARCHAR(45),
    apellido_materno VARCHAR(45),
    correo VARCHAR(45) UNIQUE,
    contrasena VARCHAR(100)
);

-- Tabla Modulo
CREATE TABLE Modulo 
(
    id_Modulo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_modulo VARCHAR(100),
    descripcion VARCHAR(100)
);

-- Tabla Contenido
CREATE TABLE Contenido 
(
    id_Contenido INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    tipo VARCHAR(100),
    descripcion TEXT,
    imagen VARCHAR(255),
    id_Modulo INT,
    FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);

-- Tabla Evaluacion
CREATE TABLE Evaluacion 
(
    id_Evaluacion INT AUTO_INCREMENT PRIMARY KEY,
    id_Modulo INT,
    FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);

-- Tabla Resultado_evaluacion
CREATE TABLE Resultado_evaluacion 
(
    idResultado_evaluacion INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    puntaje INT,
    id_Usuario INT,
    id_Evaluacion INT,
    UNIQUE (id_Usuario, id_Evaluacion),
    FOREIGN KEY (id_Usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_Evaluacion) REFERENCES Evaluacion(id_Evaluacion)
);

-- Tabla Progreso (maneja la relación Usuario-Modulo)
CREATE TABLE Progreso 
(
    id_Progreso INT AUTO_INCREMENT PRIMARY KEY,
    fecha_ultimo_acceso DATE,
    lecciones_completadas INT,
    estado VARCHAR(20),
    id_Usuario INT,
    id_Modulo INT,
    FOREIGN KEY (id_Usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);

INSERT INTO Modulo (nombre_modulo, descripcion)
VALUES 
('Abecedario LSM', 'Aprende las letras para comunicarte desde lo básico.'),
('Palabras Clave', 'Aprende palabras comunes para el día a día.'),
('Frases Comunes', 'Aprende a comunicarte con frases completas.');

INSERT INTO Contenido (titulo, tipo, descripcion, imagen, id_Modulo)
VALUES
('A','Dactilología','Se cierra la mano con los dedos juntos, se muestran las uñas y el pulgar se coloca a un lado.','imag/abecedario/a.png',1),
('B','Dactilología','La mano se coloca abierta con los dedos juntos y estirados, el pulgar doblado hacia la palma.','imag/abecedario/b.png',1),
('C','Dactilología','Los dedos y el pulgar se curvan formando la figura de la letra C.','imag/abecedario/c.png',1),
('D','Dactilología','El dedo índice se mantiene estirado mientras los demás dedos se unen con el pulgar.','imag/abecedario/d.png',1),
('E','Dactilología','Los dedos se doblan completamente hacia la palma mostrando las uñas.','imag/abecedario/e.png',1),
('F','Dactilología','El dedo índice toca el pulgar formando un círculo, los demás dedos permanecen estirados.','imag/abecedario/f.png',1),
('G','Dactilología','El pulgar y el índice se mantienen estirados en forma horizontal.','imag/abecedario/g.png',1),
('H','Dactilología','El índice y el medio se mantienen estirados y juntos en posición horizontal.','imag/abecedario/h.png',1),
('I','Dactilología','El dedo meñique se mantiene estirado mientras los demás permanecen cerrados.','imag/abecedario/i.png',1),
('J','Dactilología','Con el dedo meñique estirado se traza en el aire la forma de la letra J.','imag/abecedario/j.png',1),
('K','Dactilología','El pulgar, índice y medio se estiran formando una figura similar a la letra K.','imag/abecedario/k.png',1),
('L','Dactilología','El pulgar y el índice forman un ángulo recto simulando la letra L.','imag/abecedario/l.png',1),
('M','Dactilología','Tres dedos se colocan sobre el pulgar cerrado.','imag/abecedario/m.png',1),
('N','Dactilología','Dos dedos se colocan sobre el pulgar cerrado.','imag/abecedario/n.png',1),
('Ñ','Dactilología','Se realiza el mismo gesto que la N pero con un movimiento lateral.','imag/abecedario/ñ.png',1),
('O','Dactilología','Todos los dedos se juntan formando un círculo.','imag/abecedario/o.png',1),
('P','Dactilología','Se forma como la K pero inclinada hacia abajo.','imag/abecedario/p.png',1),
('Q','Dactilología','La mano adopta una forma similar a una garra con movimiento hacia abajo.','imag/abecedario/q.png',1),
('R','Dactilología','El índice y el medio se cruzan entre sí.','imag/abecedario/r.png',1),
('S','Dactilología','Se cierra el puño con el pulgar por fuera.','imag/abecedario/s.png',1),
('T','Dactilología','El pulgar se coloca entre el índice y el medio.','imag/abecedario/t.png',1),
('U','Dactilología','El índice y el medio se mantienen juntos y estirados.','imag/abecedario/u.png',1),
('V','Dactilología','El índice y el medio se separan formando una V.','imag/abecedario/v.png',1),
('W','Dactilología','Tres dedos se mantienen estirados y separados.','imag/abecedario/w.png',1),
('X','Dactilología','El índice se curva formando un gancho.','imag/abecedario/x.png',1),
('Y','Dactilología','El pulgar y el meñique se estiran mientras los demás permanecen cerrados.','imag/abecedario/y.png',1),
('Z','Dactilología','Con el dedo índice se dibuja la forma de la letra Z en el aire.','imag/abecedario/z.png',1);

INSERT INTO Contenido (titulo, tipo, descripcion, imagen, id_Modulo)
VALUES
('¿Cuál es tu nombre?','Frase','Pregunta usando configuración "L" y señalando a la persona.','imag/frases/nombre.png',3),
('De nada','Frase','Mano abierta desde la barbilla se desliza hacia adelante.','imag/frases/de_nada.png',3),
('Ayuda','Frase','Puño cerrado sobre palma abierta, ambas manos suben juntas.','imag/frases/ayuda.png',3),
('Lo siento','Frase','Mano en puño frotando en círculos sobre el pecho.','imag/frases/lo_siento.png',3),
('Tengo sed','Frase','Dedos en "V" desde la garganta bajan por el cuello.','imag/frases/sed.png',3),
('Con permiso','Frase','Mano en "5" pasa entre índice y medio de la otra mano.','imag/frases/con_permiso.png',3),
('¿De dónde eres?','Frase','Dedos índice y pulgar juntos tocan la barbilla y luego apuntan al frente.','imag/frases/de_donde.png',3),
('¿Cuánto cuesta?','Frase','Ambas manos en "O" chocan varias veces.','imag/frases/cuanto_cuesta.png',3),
('Estoy enfermo','Frase','Mano en la frente y otra en el estómago.','imag/frases/enfermo.png',3),
('Me gusta','Frase','Mano desde el pecho hacia adelante con sonrisa.','imag/frases/me_gusta.png',3);

INSERT INTO Contenido (titulo, tipo, descripcion, imagen, id_Modulo)
VALUES
('Hola','Palabra','Saludo básico usando movimiento desde la frente.','imag/palabras/hola.png',2),
('Adiós','Palabra','Movimiento de despedida con la mano.','imag/palabras/adios.png',2),
('Buen día','Palabra','Se combina “bien” con el gesto de día.','imag/palabras/buen_dia.png',2),
('Buenas noches','Palabra','Movimiento descendente simulando oscuridad.','imag/palabras/buenas_noches.png',2),
('Gracias','Palabra','Mano desde la barbilla hacia adelante.','imag/palabras/gracias.png',2),
('Por favor','Palabra','Movimiento circular en el pecho.','imag/palabras/por_favor.png',2),
('Mamá','Palabra','Seña cerca de la mejilla.','imag/palabras/mama.png',2),
('Papá','Palabra','Se realiza cerca de la frente.','imag/palabras/papa.png',2),
('Hermano','Palabra','Movimiento entre ambas manos.','imag/palabras/hermano.png',2),
('Hermana','Palabra','Similar a hermano pero con variación.','imag/palabras/hermana.png',2),
('Abuelo','Palabra','Movimiento desde la frente hacia adelante.','imag/palabras/abuelo.png',2),
('Hijo','Palabra','Movimiento desde el vientre hacia adelante.','imag/palabras/hijo.png',2),
('Uno','Palabra','Dedo índice levantado.','imag/palabras/uno.png',2),
('Dos','Palabra','Índice y medio levantados.','imag/palabras/dos.png',2),
('Tres','Palabra','Tres dedos levantados.','imag/palabras/tres.png',2),
('Cuatro','Palabra','Cuatro dedos extendidos.','imag/palabras/cuatro.png',2),
('Cinco','Palabra','Mano completamente abierta.','imag/palabras/cinco.png',2),
('Diez','Palabra','Movimiento del puño cerrado.','imag/palabras/diez.png',2);

-- Tabla para Banco de Preguntas
CREATE TABLE IF NOT EXISTS Pregunta (
  id_pregunta INT AUTO_INCREMENT PRIMARY KEY,
  id_Modulo INT,
  imagen VARCHAR(255),
  respuesta_correcta VARCHAR(100),
  opcion1 VARCHAR(100),
  opcion2 VARCHAR(100),
  opcion3 VARCHAR(100),
  FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);

-- Tabla para Historial de Evaluaciones
CREATE TABLE IF NOT EXISTS Historial_evaluacion (
  id_historial INT AUTO_INCREMENT PRIMARY KEY,
  id_Usuario INT,
  id_Evaluacion INT,
  puntaje INT,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_Usuario) REFERENCES Usuario(id_usuario),
  FOREIGN KEY (id_Evaluacion) REFERENCES Evaluacion(id_Evaluacion)
);

INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/a.png', 'A', 'B', 'C', 'D');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/b.png', 'B', 'A', 'C', 'E');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/c.png', 'C', 'A', 'B', 'D');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/d.png', 'D', 'A', 'C', 'E');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/e.png', 'E', 'D', 'F', 'A');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/f.png', 'F', 'E', 'G', 'B');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/g.png', 'G', 'F', 'H', 'C');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/h.png', 'H', 'G', 'I', 'D');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/i.png', 'I', 'H', 'J', 'E');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/j.png', 'J', 'I', 'K', 'F');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/k.png', 'K', 'J', 'L', 'G');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/l.png', 'L', 'K', 'M', 'H');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/m.png', 'M', 'L', 'N', 'I');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/n.png', 'N', 'M', 'D', 'J');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/ñ.png', 'Ñ', 'K', 'M', 'Q');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/o.png', 'O', 'D', 'P', 'L');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/p.png', 'P', 'O', 'Q', 'M');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/q.png', 'Q', 'P', 'R', 'N');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/r.png', 'R', 'Q', 'S', 'O');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/s.png', 'S', 'R', 'T', 'P');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/t.png', 'T', 'S', 'U', 'Q');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/u.png', 'U', 'T', 'V', 'R');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/v.png', 'V', 'U', 'W', 'S');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/w.png', 'W', 'V', 'X', 'T');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/x.png', 'X', 'W', 'Y', 'U');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/y.png', 'Y', 'X', 'Z', 'V');
INSERT INTO pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES (1, 'imag/abecedario/z.png', 'Z', 'Y', 'A', 'W');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/hola.png', 'Hola', 'Adiós', 'Buen día', 'Buenas noches');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/adios.png', 'Adiós', 'Buen día', 'Buenas noches', 'Gracias');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/buen_dia.png', 'Buen día', 'Buenas noches', 'Gracias', 'Por favor');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/buenas_noches.png', 'Buenas noches', 'Gracias', 'Por favor', 'Mamá');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/gracias.png', 'Gracias', 'Por favor', 'Mamá', 'Papá');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/por_favor.png', 'Por favor', 'Mamá', 'Papá', 'Hermano');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/mama.png', 'Mamá', 'Papá', 'Hermano', 'Hermana');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/papa.png', 'Papá', 'Hermano', 'Hermana', 'Abuelo');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/hermano.png', 'Hermano', 'Hermana', 'Abuelo', 'Hijo');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/hermana.png', 'Hermana', 'Abuelo', 'Hijo', 'Uno');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/abuelo.png', 'Abuelo', 'Hijo', 'Uno', 'Dos');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/hijo.png', 'Hijo', 'Uno', 'Dos', 'Tres');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/uno.png', 'Uno', 'Dos', 'Tres', 'Cuatro');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/dos.png', 'Dos', 'Tres', 'Cuatro', 'Cinco');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/tres.png', 'Tres', 'Cuatro', 'Cinco', 'Diez');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/cuatro.png', 'Cuatro', 'Cinco', 'Diez', 'Hola');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/cinco.png', 'Cinco', 'Diez', 'Hola', 'Adiós');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('2', 'imag/palabras/diez.png', 'Diez', 'Hola', 'Adiós', 'Buen día');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/nombre.png', '¿Cuál es tu nombre?', 'De nada', 'Ayuda', 'Lo siento');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/de_nada.png', 'De nada', 'Ayuda', 'Lo siento', 'Tengo sed');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/ayuda.png', 'Ayuda', 'Lo siento', 'Tengo sed', 'Con permiso');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/lo_siento.png', 'Lo siento', 'Tengo sed', 'Con permiso', '¿De dónde eres?');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/sed.png', 'Tengo sed', 'Con permiso', '¿De dónde eres?', '¿Cuánto cuesta?');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/con_permiso.png', 'Con permiso', '¿De dónde eres?', '¿Cuánto cuesta?', 'Estoy enfermo');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/de_donde.png', '¿De dónde eres?', '¿Cuánto cuesta?', 'Estoy enfermo', 'Me gusta');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/cuanto_cuesta.png', '¿Cuánto cuesta?', 'Estoy enfermo', 'Me gusta', '¿Cuál es tu nombre?');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/enfermo.png', 'Estoy enfermo', 'Me gusta', '¿Cuál es tu nombre?', 'De nada');
INSERT INTO Pregunta (id_Modulo, imagen, respuesta_correcta, opcion1, opcion2, opcion3) VALUES ('3', 'imag/frases/me_gusta.png', 'Me gusta', '¿Cuál es tu nombre?', 'De nada', 'Ayuda');

INSERT INTO Evaluacion (id_Evaluacion, id_Modulo) VALUES (1, 1);
INSERT INTO Evaluacion (id_Evaluacion, id_Modulo) VALUES (2, 2);
INSERT INTO Evaluacion (id_Evaluacion, id_Modulo) VALUES (3, 3);