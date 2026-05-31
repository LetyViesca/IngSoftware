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
