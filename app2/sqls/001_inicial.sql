CREATE DATABASE app2 COLLATE 'utf8_unicode_ci';

CREATE TABLE contatos (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    endereco VARCHAR(255),
    telefone1 VARCHAR(255),
    telefone2 VARCHAR(255),
    telefone3 VARCHAR(255),
    PRIMARY KEY (id)
)
ENGINE = InnoDB;
