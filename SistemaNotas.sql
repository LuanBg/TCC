CREATE DATABASE IF NOT EXISTS SistemaNotas;
USE SistemaNotas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_acesso ENUM('admin', 'user') NOT NULL,
    usuario VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE gerenciamento_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'user') NOT NULL
);


CREATE TABLE IF NOT EXISTS empresas (
    codigo_empresa VARCHAR(255) PRIMARY KEY,
    cnpj VARCHAR(20) NOT NULL
);

select*from empresas ;
select*from usuarios ;


INSERT INTO usuarios (email, senha, tipo_acesso, usuario)
VALUES ('admin@exemplo.com', '1234', 'admin', 'admin');


select*from  usuarios;
select*from gerenciamento_usuarios;
INSERT INTO gerenciamento_usuarios (nome_usuario, tipo)
VALUES ('Administrador', 'admin');
