CREATE DATABASE smc_db;

USE smc_db;

#  Tabla Roles
CREATE TABLE Roles(
    id_Rol INT PRIMARY KEY AUTO_INCREMENT,
    name_rol VARCHAR(50) NOT NULL UNIQUE
);

# Tabla de empresa
CREATE TABLE empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nombre_empresa VARCHAR(30) NOT NULL,
    comentarios TEXT NULL
)AUTO_INCREMENT = 201;

# Tabla de usuarios
CREATE TABLE usuarios (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    img_perfil VARCHAR(255) NULL,
    descripcion VARCHAR(255) NULL,
    idRol INT NOT NULL,
    CONSTRAINT FK_Roles FOREIGN KEY (idRol) REFERENCES Roles (id_Rol),
    id_empresa INT NULL,
    CONSTRAINT FK_empresa FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa)
)AUTO_INCREMENT = 101;

# Tabla clientes
CREATE TABLE clientes (
    id_empresa INT NOT NULL,
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(100),
    direccion VARCHAR(150),
    FOREIGN KEY (id_empresa) REFERENCES Empresa(id_empresa)
);

# Tabla de compras
CREATE TABLE compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    compra VARCHAR(100),
    precio DOUBLE NOT NULL,
    fecha_compra DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)AUTO_INCREMENT = 301;

# Inserción de datos iniciales para roles
INSERT INTO Roles (name_rol) VALUES 
    ('Administrador'), 
    ('Usuario');

