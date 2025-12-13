CREATE DATABASE smc_db;
USE smc_db;

-- ===============================
-- TABLA ROLES
-- ===============================
CREATE TABLE roles (
    id_Rol INT PRIMARY KEY AUTO_INCREMENT,
    name_rol VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO roles (name_rol) VALUES
('Administrador'),
('Usuario');

-- ===============================
-- TABLA EMPRESA
-- ===============================
CREATE TABLE empresa (
    id_empresa INT PRIMARY KEY AUTO_INCREMENT,
    nombre_empresa VARCHAR(30) NOT NULL,
    comentarios TEXT
)AUTO_INCREMENT = 201;

-- ===============================
-- TABLA USUARIOS
-- ===============================
CREATE TABLE usuarios (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    img_perfil VARCHAR(255),
    descripcion VARCHAR(255),
    idRol INT NOT NULL,
    id_empresa INT DEFAULT NULL,
    FOREIGN KEY (idRol) REFERENCES roles(id_Rol),
    FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa)
)AUTO_INCREMENT = 101;

-- ===============================
-- TABLA CLIENTES
-- ===============================
CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa INT NOT NULL,
    nombre_cliente VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(100),
    direccion VARCHAR(150),
    FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa)
)AUTO_INCREMENT = 301;

-- ===============================
-- TABLA COMENTARIOS
-- ===============================
CREATE TABLE comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,       -- usuario que recibe el comentario
    autor_id INT NOT NULL,         -- usuario que escribe el comentario
    comentario TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_user) ON DELETE CASCADE,
    FOREIGN KEY (autor_id) REFERENCES usuarios(id_user) ON DELETE CASCADE
);

-- ===============================
-- TABLA LIKES DE USUARIOS
-- ===============================
CREATE TABLE likes_usuarios (
    id_like INT PRIMARY KEY AUTO_INCREMENT,
    id_liked INT NOT NULL,     -- usuario que recibe el like
    id_user INT NOT NULL,      -- usuario que da el like
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_liked) REFERENCES usuarios(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES usuarios(id_user) ON DELETE CASCADE
);

-- ===============================
-- INSERTAR DATOS DE EJEMPLO
-- ===============================

INSERT INTO empresa (nombre_empresa, comentarios) VALUES
('Repstor', 'la mejor vena'),
('MiEmpresa', 'asasd'),
('masndalsn', 'okoko'),
('Repstor', 'mm');

INSERT INTO usuarios (nombres, username, correo, contrasena, img_perfil, descripcion, idRol)
VALUES
('edwin jimenez', 'wiwin10', 'edwinjimenez050703@gmail.com',
'$2y$10$WI1d24vhHlfTzOUIy2bhr.po0SkyVM1SzErSKlTaUBoJXyJC7b3Se', NULL, NULL, 2),

('edwin', 'edwin', 'asd123@gmail.com',
'$2y$10$l2YDZCzjskKDZ66sZfvk1uvu/NRsmClGHAdM2K5UHvpLK7xjaQRA.',
'views/assets/uploads/perfil_102.png', 'asdasdasd', 1),

('useredwin', 'edwinuser', 'ajsdlkajsldk@gmail.com',
'$2y$10$8W4gjIO90cHpsVMzcb0YUu9H0fLMrPR.hGUX7qonQMywjWS9wDGdC',
NULL, NULL, 2);

INSERT INTO clientes (id_empresa, nombre_cliente, telefono, correo, direccion)
VALUES (201, 'Hector', '65687984562', 'asdqiwoeu@gmail.com', 'juanitocamelo');

-- Likes de usuarios (perfil)
INSERT INTO likes_usuarios (id_liked, id_user) VALUES
(101, 102),
(103, 102);

-- Comentarios existentes
INSERT INTO comentarios (id_usuario, autor_id, comentario)
VALUES
(102, 102, 'bula'),
(102, 102, 'd'),
(102, 102, 'juanito editado'),
(102, 102, 'ss'),
(102, 102, 'nooooooooooooooo');
