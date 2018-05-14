CREATE DATABASE app3 COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) UNIQUE NOT NULL,
    senha CHAR(60) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE reclamacoes (
    id INT NOT NULL AUTO_INCREMENT,
    data_incidente TIMESTAMP NOT NULL,
    local VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    data_atendimento TIMESTAMP NULL DEFAULT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)
ENGINE = InnoDB;

INSERT INTO usuarios (nome, senha, admin) 
VALUES ('admin', 
		'$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', 
		true);
