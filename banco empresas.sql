-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sefaz_empresas;
USE sefaz_empresas;

-- Tabela para armazenar os dados das empresas e seus logins SEFAZ
CREATE TABLE IF NOT EXISTS empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo  VARCHAR(10) NOT NULL,
    usuario VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela para registrar falhas no processo de download por empresa
CREATE TABLE IF NOT EXISTS falhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT,
    motivo TEXT,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

select*from empresas ;


