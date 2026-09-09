CREATE DATABASE IF NOT EXISTS drone;
USE drone;
CREATE TABLE IF NOT EXISTS listeCommande(
    idlisteCommande INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(45)
);
CREATE TABLE IF NOT EXISTS drone(
    iddrone INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    marque VARCHAR(45),
    modele VARCHAR(45),
    refdrone VARCHAR(45),
    dateAchat TIMESTAMP
);
CREATE TABLE IF NOT EXISTS utilisateur(
    idutilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(45),
    prenom VARCHAR(45),
    email VARCHAR(45),
    naissance DATE,
    pseudo VARCHAR(45),
    mdp VARCHAR(45)
);
CREATE TABLE IF NOT EXISTS vol(
    idvol INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idutilisateur INT,
    datevol TIMESTAMP,
    iddrone INT,
    FOREIGN KEY (idutilisateur) REFERENCES utilisateur(idutilisateur),
    FOREIGN KEY (iddrone) REFERENCES drone(iddrone)
);

CREATE TABLE IF NOT EXISTS etat(
    idetat INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idvol INT,
    pitch FLOAT, 
    roll FLOAT,
    yaw FLOAT,
    vgx FLOAT,
    vgy FLOAT,
    vgz FLOAT,
    templ INT,
    temph INT,
    tof INT,
    h INT,
    bat INT,
    baro FLOAT,
    time INT,
    agx FLOAT,
    agy FLOAT,
    agz FLOAT,
    FOREIGN KEY (idvol) REFERENCES vol(iddrone)
);
CREATE TABLE IF NOT EXISTS commande(
    idcommande INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idetat INT,
    idlisteCommande INT,
    valeur VARCHAR(11),
    time_ms INT,
    FOREIGN KEY (idetat) REFERENCES etat(idetat),
    FOREIGN KEY (idlisteCommande) REFERENCES listeCommande(idlisteCommande)
);


