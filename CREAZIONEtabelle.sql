CREATE DATABASE IF NOT EXISTS  TeamTactiCoach;
USE TeamTactiCoach;
 
 CREATE TABLE IF NOT EXISTS Tenant (
    TenantID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255),
    Password VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Squadra (
    SquadraID VARCHAR(255) PRIMARY KEY ,
    Categoria VARCHAR(255),
    Username VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS AllenatoreTesserato (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255),
    Password VARCHAR(255),
    Username VARCHAR(255),
    Nome VARCHAR(255),
    Cognome VARCHAR(255),
    DataNascita DATE,
    ruolo VARCHAR(255),
    TenantID INT, 
    FOREIGN KEY (TenantID) REFERENCES Tenant(TenantID) 
);


CREATE TABLE IF NOT EXISTS Partita (

    PartitaID INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE,
    Risultato VARCHAR(255),
    Avversario VARCHAR(255),
    SquadraID VARCHAR(255)
    
);

CREATE TABLE IF NOT EXISTS Giocatore (
    GiocatoriID INT PRIMARY KEY AUTO_INCREMENT,
    SquadraID VARCHAR(255) REFERENCES Squadra(SquadraID),
    Nickname VARCHAR(255)

);

CREATE TABLE IF NOT EXISTS Allenamento (
    AllenamentoID INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE,
    SquadraID VARCHAR(255) REFERENCES Squadra(SquadraID)
);

CREATE TABLE IF NOT EXISTS Partecipa (
    GiocatoreID INT REFERENCES Giocatore(GiocatoreID),
    AllenamentoID INT REFERENCES Allenamento(AllenamentoID),
    Presenza BOOLEAN
);

CREATE TABLE IF NOT EXISTS Statistiche (
    GiocatoreID INT  REFERENCES Giocatore(GiocatoreID),  
    PartitaID INT  REFERENCES Partita(PartitaID),
    SquadraID VARCHAR(255) REFERENCES Squadra(SquadraID),
    statsID INT PRIMARY KEY AUTO_INCREMENT,
    Gol INT,
    Assist INT,
    CartelliniGialli INT,
    CartelliniRossi INT,
    Titolare BOOLEAN
);
USE TeamTactiCoach;


INSERT INTO Tenant (Nome, Password) VALUES
('FGC', MD5('FGC')),
('CSI', MD5('CSI'));



INSERT INTO Squadra ( Categoria, Username) VALUES
( 'Allievi', 'Username1'),
( 'Giovanissimi', 'Username2'),
( 'Esordienti', 'Username3');


INSERT INTO AllenatoreTesserato (email, Password, Username, Nome, Cognome, DataNascita, ruolo, TenantID) VALUES
('email1@example.com', MD5('password1'), 'Username1', 'Nome1', 'Cognome1', '1990-01-01', 'Ruolo1', 1),
('email2@example.com', MD5('password2'), 'Username2', 'Nome2', 'Cognome2', '1991-02-02', 'Ruolo2', 2),
('email3@example.com', MD5('password3'), 'Username3', 'Nome3', 'Cognome3', '1992-03-03', 'Ruolo3', 2),
('email4@example.com', MD5('password4'), 'Username4', 'Nome3', 'Cognome4', '1992-03-04', 'admin', 1);

INSERT INTO Partita (Data, Risultato, Avversario, SquadraID) VALUES
('2024-01-01', '2-1', 'Avversario1', 1),
('2024-01-02', '1-1', 'Avversario2', 2),
('2024-01-03', '3-0', 'Avversario3', 3);


INSERT INTO Giocatore (SquadraID, Nickname) VALUES
(1, 'Giocatore1'),
(2, 'Giocatore2'),
(3, 'Giocatore3');


INSERT INTO Allenamento (Data, SquadraID) VALUES
('2024-02-01', 1),
('2024-02-02', 2),
('2024-02-03', 3);


INSERT INTO Partecipa (GiocatoreID, AllenamentoID, Presenza) VALUES
(1, 1, TRUE),
(2, 2, TRUE),
(3, 3, TRUE);


INSERT INTO Statistiche (GiocatoreID, PartitaID, SquadraID, Gol, Assist, CartelliniGialli, CartelliniRossi, Titolare) VALUES
(1, 1, 1, 1, 0, 0, 0, TRUE),
(2, 2, 2, 0, 1, 0, 0, TRUE),
(3, 3,3, 0, 0, 0, 0, TRUE);
