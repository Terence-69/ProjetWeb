CREATE DATABASE Meteo;
use Meteo;

CREATE USER 'meteo'@'localhost' IDENTIFIED BY 'meteo';
GRANT ALL PRIVILEGES ON Meteo.* TO 'meteo'@'localhost';

CREATE TABLE city (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30),
    ventVitesse DOUBLE,
    ventDirection CHAR(5),
    leveSoleil VARCHAR(30),
    coucheSoleil VARCHAR(30),
    humidite DOUBLE,
    visibilite DOUBLE,
    paysCode VARCHAR(30),
    temperature DOUBLE,
    conditionMeteo VARCHAR(100),
    icon VARCHAR(30),
    PRIMARY KEY (id)
);

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    pwd VARCHAR(255),
    city VARCHAR(100)
);