podman run --name db-montink -p 3306:3306 -e MYSQL_ROOT_PASSWORD=password -d docker.io/mysql:latest

CREATE DATABASE erp;
USE erp;

CREATE TABLE produto(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(6,2) NOT NULL,
    variacoes VARCHAR(100)
);

CREATE TABLE estoque(
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY(id_produto) REFERENCES produto(id) ON DELETE CASCADE
);

CREATE TABLE pedido(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    valor DECIMAL(6,2) NOT NULL,
    data DATE NOT NULL,
    nome VARCHAR(150) NOT NULL
);

CREATE TABLE cupom(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    validade DATE NOT NULL,
    valor_minimo DECIMAL(6,2) NOT NULL
);