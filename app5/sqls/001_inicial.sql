CREATE DATABASE app5 COLLATE 'utf8_unicode_ci';

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE vendas (
    id INT NOT NULL AUTO_INCREMENT ,
    produto_id INT NOT NULL ,
    quantidade INT NOT NULL ,
    preco_total DECIMAL(10,2) NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (produto_id) REFERENCES produtos (id)
)
ENGINE = InnoDB;

INSERT INTO produtos(nome) VALUES ('Processador'), ('Placa-mãe'), ('Placa de vídeo');
INSERT INTO vendas(produto_id, quantidade, preco_total) VALUES (1, 1, 400), (1, 2, 600), (1, 1, 500), (1, 3, 1000), (1, 1, 450), (1, 2, 350), (2, 1, 400), (2, 3, 300), (2, 2, 175), (2, 4, 500), (2, 5, 500), (2, 2, 250), (2, 1, 300), (3, 1, 1500), (3, 1, 1200), (3, 2, 3500), (3, 1, 1300), (3, 1, 1400), (3, 1, 1550), (3, 2, 2900), (3, 1, 1600), (3, 1, 1400);
