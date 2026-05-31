CREATE DATABASE IF NOT EXISTS zigna CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE zigna;

CREATE TABLE IF NOT EXISTS Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Modulo (
    id_Modulo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

CREATE TABLE IF NOT EXISTS Progreso (
    id_progreso INT AUTO_INCREMENT PRIMARY KEY,
    fecha_ultimo_acceso DATE NOT NULL,
    lecciones_completadas INT NOT NULL DEFAULT 0,
    estado VARCHAR(40) NOT NULL,
    id_Usuario INT NOT NULL,
    id_Modulo INT NOT NULL,
    FOREIGN KEY (id_Usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);

CREATE TABLE IF NOT EXISTS Contenido (
    id_contenido INT AUTO_INCREMENT PRIMARY KEY,
    id_Modulo INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    FOREIGN KEY (id_Modulo) REFERENCES Modulo(id_Modulo)
);
