CREATE DATABASE app4 COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario_id INT NOT NULL ,
    texto VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;
