DROP DATABASE IF EXISTS eval;

CREATE DATABASE eval;

USE eval;

CREATE TABLE client(
    cli_num int NOT NULL AUTO_INCREMENT,
    cli_nom varchar(50) NOT NULL,
    cli_adresse varchar(50),
    cli_tel varchar(30),
    PRIMARY KEY (cli_num) 
);

CREATE TABLE produit(
    pro_num int NOT NULL AUTO_INCREMENT,
    pro_libelle varchar(50) NOT NULL,
    pro_description varchar(50),
    PRIMARY KEY (pro_num)
);

CREATE TABLE commande(
    com_num int NOT NULL AUTO_INCREMENT,
    cli_num int NOT NULL,
    com_date    timestamp NOT NULL,
    com_obs varchar(50),
    PRIMARY KEY (com_num),
    CONSTRAINT com_fk FOREIGN KEY (cli_num) REFERENCES client (cli_num)
);

CREATE TABLE est_compose(
    com_num int NOT NULL,
    pro_num int NOT NULL,
    est_qte int NOT NULL,
    PRIMARY KEY (com_num, pro_num),
    CONSTRAINT est_fk1 FOREIGN KEY (com_num) REFERENCES commande (com_num),
    CONSTRAINT est_fk2 FOREIGN KEY (pro_num) REFERENCES produit (pro_num)
);

CREATE INDEX index_noms
ON client (cli_nom);