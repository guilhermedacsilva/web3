CREATE DATABASE app1 COLLATE 'utf8_unicode_ci';

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario VARCHAR(255) NOT NULL ,
    texto VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;
