CREATE DATABASE IF NOT EXISTS SistemaNotas;
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



CREATE TABLE IF NOT EXISTS empresas (
    codigo_empresa VARCHAR(255) PRIMARY KEY,
    cnpj VARCHAR(20) NOT NULL
);

CREATE TABLE logs_execucao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_empresa VARCHAR(255),
    cnpj VARCHAR(20),
    status ENUM('sucesso', 'erro') NOT NULL,
    mensagem TEXT,
    duracao_segundos FLOAT,
    data_execucao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (codigo_empresa) REFERENCES empresas(codigo_empresa)
);


select*from empresas ;
select*from usuarios ;


insert into usuarios (email, senha,tipo_acesso) values ('admim@exemplo.com','1234' ,'admin');

select*from  usuarios;
select*from gerenciamento_usuarios;
INSERT INTO gerenciamento_usuarios (nome_usuario, tipo)
VALUES ('Administrador', 'admin');