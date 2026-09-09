CREATE DATABASE drone;
USE drone;
CREATE TABLE listeCommande(
    idlisteCommande INT PRIMARY KEY NOT NULL,
    nom VARCHAR(45)
);
CREATE TABLE etat(
    idetat INT PRIMARY KEY NOT NULL,
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
    agz FLOAT
);
CREATE TABLE commande(
    idcommande INT PRIMARY KEY NOT NULL,
    idetat INT,
    idlisteCommande INT,
    valeur VARCHAR(11),
    time_ms INT,
    FOREIGN KEY (idetat) REFERENCES etat(idetat),
    FOREIGN KEY (idlisteCommande) REFERENCES listeCommande(idlisteCommande)
);
CREATE TABLE utilisateur(
    idutilisateur INT PRIMARY KEY NOT NULL,
    nom VARCHAR(45),
    prenom VARCHAR(45),
    email VARCHAR(45),
    naissance DATE,
    pseudo VARCHAR(45),
    mdp VARCHAR(45)
);
CREATE TABLE drone(
    iddrone INT PRIMARY KEY NOT NULL,
    marque VARCHAR(45),
    modele VARCHAR(45),
    refdrone VARCHAR(45),
    dateAchat TIMESTAMP
);
CREATE TABLE vol(
    idvol INT PRIMARY KEY NOT NULL,
    idutilisateur INT,
    datevol TIMESTAMP,
    iddrone INT,
    FOREIGN KEY (idutilisateur) REFERENCES utilisateur(idutilisateur),
    FOREIGN KEY (iddrone) REFERENCES drone(iddrone)
);
