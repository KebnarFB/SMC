CREATE DATABASE IF NOT EXISTS smc_db;

USE smc_db;

# Tabla de usuarios
CREATE TABLE usuarios (
    # Datos Iniciales del Form
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
)AUTO_INCREMENT = 101;

# Tabla clientes
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    nombre_cliente VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(100),
    direccion VARCHAR(150),
    FOREIGN KEY (id_empresa) REFERENCES Empresa(id_empresa)
);

# Tabla de empresa
CREATE TABLE empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nombre_empresa VARCHAR(30) NOT NULL,
    comentarios TEXT NULL
)AUTO_INCREMENT = 201;

# Tabla de compras
CREATE TABLE compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    fecha_compra DATE NOT NULL,
    total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)AUTO_INCREMENT = 301;

SELECT * FROM usuarios;