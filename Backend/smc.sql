USE smc;

# Tabla se usuarios
CREATE TABLE registro(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(255) NOT NULL
);

# Consultas
SELECT * FROM registro;