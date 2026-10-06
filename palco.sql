CREATE DATABASE palco;
USE palco;

CREATE TABLE categoria (
    id_categ INT AUTO_INCREMENT PRIMARY KEY,
    nome_show varchar(200) not null 
);

CREATE TABLE shows (
    id_show INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    descricao VARCHAR(200),
    data_show DATE NOT NULL,
    locals VARCHAR(200) NOT NULL,
    preco float NOT NULL,
    capacidade INT NOT NULL,
    ing_disponiveis INT NOT NULL,
    imagem varchar(200),
    id_categ INT,
    FOREIGN KEY (id_categ) REFERENCES Categoria(id_categ)
);

Create table vendas (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome_comprador varchar(200) NOT NULL,
 email varchar(300) NOT NULL,
 cpf varchar(14) NOT NULL, 
 qtd_ing INT NOT NULL, 
 valor_total float NOT NULL,
 data_compra TIMESTAMP NOT NULL,
 id_show INT NOT NULL,
 FOREIGN KEY (id_show) REFERENCES shows(id_show)
);

Create table usuarios (
 id_usuario INT AUTO_INCREMENT PRIMARY KEY, 
 nome_usuario varchar(200) NOT NULL,
 email_usuario varchar(300) NOT NULL,
 senha varchar(30) NOT NULL
 );
