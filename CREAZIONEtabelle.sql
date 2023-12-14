CREATE DATABASE IF NOT EXISTS  TeamTactiCoach;
USE TeamTactiCoach;
 
CREATE TABLE IF NOT EXISTS Squadra (
    SquadraID VARCHAR(255) PRIMARY KEY ,
    Categoria VARCHAR(255),
    UserID INT REFERENCES AllenatoreTesserato(UserID),
);
CREATE TABLE IF NOT EXISTS AllenatoreTesserato (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(255),
    Password VARCHAR(255),
    Username VARCHAR(255),
    Nome VARCHAR(255),
    Cognome VARCHAR(255),
    DataNascita DATE,
    ruolo VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Partita (
    PartitaID INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE,
    Risultato VARCHAR(255),
    Avversario VARCHAR(255),
    SquadraID INT REFERENCES Squadra(SquadraID)
);

CREATE TABLE IF NOT EXISTS Giocatore (
    GiocatoriID INT PRIMARY KEY AUTO_INCREMENT,
    SquadraID INT REFERENCES Squadra(SquadraID),
    Nickname VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Allenamento (
    AllenamentoID INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE
);

CREATE TABLE IF NOT EXISTS Partecipa (
    GiocatoreID INT REFERENCES Giocatore(GiocatoreID),
    AllenamentoID INT REFERENCES Allenamento(AllenamentoID),
    Presenza BOOLEAN
);

CREATE TABLE IF NOT EXISTS Statistiche (
    GiocatoreID INT  REFERENCES Giocatore(GiocatoreID),  
    PartitaID INT  REFERENCES Partita(PartitaID),
    PRIMARY KEY(GiocatoreID,PartitaID),
    Gol INT,
    Assist INT,
    CartelliniGialli INT,
    CartelliniRossi INT,
    Titolare BOOLEAN
);
