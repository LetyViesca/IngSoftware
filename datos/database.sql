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
    descripcion VARCHAR(45)
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
