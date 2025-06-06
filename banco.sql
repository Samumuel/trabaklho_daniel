-- Active: 1726102402957@@127.0.0.1@3306@pokemon
CREATE TABLE pokemon (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(10),
    tipo VARCHAR(10),
    estagio VARCHAR(1),
    hp VARCHAR(4),
    ataque VARCHAR(4),
    defesa VARCHAR(4)
);