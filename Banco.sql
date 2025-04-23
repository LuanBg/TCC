CREATE DATABASE SistemaNotas;
USE SistemaNotas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_acesso ENUM('admin', 'user') NOT NULL
);

CREATE TABLE gerenciamento_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'user') NOT NULL
);

insert into usuarios (email, senha,tipo_acesso) values ('admim@exemplo.com','1234' ,'admin');

select*from  usuarios;
select*from gerenciamento_usuarios;
INSERT INTO gerenciamento_usuarios (nome_usuario, tipo)
VALUES ('Administrador', 'admin');
