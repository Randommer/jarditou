/* Partie 1 de l Evalution de SQL */
DROP DATABASE IF EXISTS eval;

/* Création d'une base pour l'évaluation */
CREATE DATABASE eval;

USE eval;

/* Création d'une table Client dans la base */
CREATE TABLE client(
    cli_num int NOT NULL AUTO_INCREMENT,
    cli_nom varchar(50) NOT NULL,
    cli_adresse varchar(50),
    cli_tel varchar(30),
    PRIMARY KEY (cli_num) 
);

/* Création d'une table Produit dans la base */
CREATE TABLE produit(
    pro_num int NOT NULL AUTO_INCREMENT,
    pro_libelle varchar(50) NOT NULL,
    pro_description varchar(50),
    PRIMARY KEY (pro_num)
);

/* Création d'une table Commande dans la base */
CREATE TABLE commande(
    com_num int NOT NULL AUTO_INCREMENT,
    cli_num int NOT NULL,
    com_date    datetime NOT NULL,
    com_obs varchar(50),
    PRIMARY KEY (com_num),
    CONSTRAINT com_fk FOREIGN KEY (cli_num) REFERENCES client (cli_num)
);

/* Création d'une table est_compose dans la base */
CREATE TABLE est_compose(
    com_num int NOT NULL,
    pro_num int NOT NULL,
    est_qte int NOT NULL,
    PRIMARY KEY (com_num, pro_num),
    CONSTRAINT est_fk1 FOREIGN KEY (com_num) REFERENCES commande (com_num),
    CONSTRAINT est_fk2 FOREIGN KEY (pro_num) REFERENCES produit (pro_num)
);

/* Création d'un index index_noms qui index les noms de la table Client */
CREATE INDEX index_noms
ON client (cli_nom);