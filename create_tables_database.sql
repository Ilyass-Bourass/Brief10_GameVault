DROP DATABASE IF EXISTS GameVault;
CREATE DATABASE GameVault;
use GameVault ;



CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_passe VARCHAR(255) NOT NULL,
    role ENUM('ADMIN', 'USER') DEFAULT 'USER',
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE jeux (
    id_jeu INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    note DECIMAL(3,1),
    temps_jeu INT DEFAULT 0
);


CREATE TABLE images_jeux (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_jeu INT,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_jeu) REFERENCES jeux(id_jeu)
);


CREATE TABLE bibliotheques (
    id_bibliotheque INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_jeu INT,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_jeu) REFERENCES jeux(id_jeu)
);

CREATE TABLE critiques (
    id_critique INT PRIMARY KEY AUTO_INCREMENT,
    id_jeu INT,
    id_user INT,
    note INT CHECK (note BETWEEN 0 AND 5),
    texte TEXT,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jeu) REFERENCES jeux(id_jeu),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);


CREATE TABLE chat (
    id_chat INT PRIMARY KEY AUTO_INCREMENT,
    id_jeu INT,
    id_user INT,
    message TEXT,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jeu) REFERENCES jeux(id_jeu),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE favoris (
    id_favori INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_jeu INT,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_jeu) REFERENCES jeux(id_jeu)
);