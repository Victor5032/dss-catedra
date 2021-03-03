CREATE DATABASE alquiler DEFAULT COLLATE utf8_unicode_ci;

USE alquiler_peliculas;

CREATE TABLE pelicula (
	id_pelicula INT AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    portada VARCHAR(150) NULL,
    precio_alquiler DECIMAL(8, 2) NOT NULL DEFAULT 0,
    precio_venta DECIMAL(8, 2) NOT NULL DEFAULT 0,
    unidades_disponibles INT NOT NULL DEFAULT 0,
    likes INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_pelicula)
);

CREATE TABLE usuario (
	id_usuario INT AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    correo VARCHAR(254) NOT NULL,
    admin TINYINT(1) NOT NULL DEFAULT 0,
    password VARCHAR(128) NOT NULL,
    fecha_nacimiento DATE NULL,
    direccion VARCHAR(150) NULL,
    telefono VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_usuario)
);

CREATE TABLE compra (
	id_compra INT AUTO_INCREMENT,
	id_pelicula INT NOT NULL,
	id_usuario INT NOT NULL,
	cantidad INT NOT NULL DEFAULT 0,
	total DECIMAL(8, 2) NOT NULL,
    fecha_compra TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_compra)
);

ALTER TABLE compra
ADD FOREIGN KEY (id_pelicula) REFERENCES pelicula (id_pelicula) ON DELETE CASCADE;

ALTER TABLE compra
ADD FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario) ON DELETE CASCADE;

CREATE TABLE alquiler (
	id_alquiler INT AUTO_INCREMENT,
	id_pelicula INT NOT NULL,
	id_usuario INT NOT NULL,
	cantidad INT NOT NULL DEFAULT 0,
    inicio DATE NOT NULL,
    fin DATE NOT NULL,
    multa DECIMAL(8, 2) NOT NULL DEFAULT 0,
	total_alquiler DECIMAL(8, 2) NOT NULL,
    fecha_alquiler TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_alquiler)
);

ALTER TABLE alquiler
ADD FOREIGN KEY (id_pelicula) REFERENCES pelicula (id_pelicula) ON DELETE CASCADE;

ALTER TABLE alquiler
ADD FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario) ON DELETE CASCADE;


