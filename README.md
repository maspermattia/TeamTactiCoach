# TeamTactiCoach
**prerequisito:**

avere XAMP sulla propria macchina, e dentro htdocs la cartella di TeamTactiCoach

**PROBLEMA**

passare da carta a tecnologia per la gestione delle informazioni di tutti i componenti della squadra per sapere le statistiche di tutti i giocatori, le assenze/gol con una classifica

**TARGET**

allenatori tesserati 

## FUNZIONALITÀ:

**Registrazione Utente:**
- Registra Utente: Permette agli utenti di registrarsi inserendo il nome della squadra e altre informazioni pertinenti.
- Elimina Utente: Consente agli utenti di eliminare il proprio account, cancellando tutte le informazioni associate.

**Giocatori:**
- Aggiungi Giocatore: Permette agli utenti di inserire nuovi giocatori nella lista della squadra.
- Modifica Giocatore: Permette agli utenti di cambiare il nickname.
- Elimina Giocatore: Permette agli utenti di rimuovere un giocatore dalla squadra.

**Gestione delle partite:**
- Crea Partita: Permette agli utenti di creare e pianificare nuove partite, assegnando i titolari e impostare la data.
- Modifica Partita: Consente agli utenti di apportare modifiche alle partite già programmate, come cambiare data o avversario.
- Registra Risultati: Consente agli utenti di inserire i risultati delle partite, compresi gol, assist, e cartellini gialli/rossi.

**Gestione allenamenti:**
- permette di mettere assente o presente un giocatore e impostare la data di allenamento
  
**Classifica:**
- Visualizza Classifica: Permette agli utenti di visualizzare la classifica aggiornata.


## SCHEMA RELAZIONALE:

- squadra(<ins>squadraID</ins>,userID,categoria)
- allenatoretesserato(<ins>userID</ins>,email,password,username,nome,cognome,dataDiNascita,ruolo,<ins>TenantID</ins>)
- partita(<ins>partitaID</ins>,data,risultato,avversario,squadraID)
- giocatore(<ins>giocatoriID</ins>,squadraID,nickname)
- allenamento(<ins>allenamentoID</ins>,data)
- partecipa(<ins>giocatoreID</ins>,<ins>allenamentoID</ins>,presenza)
- statistiche(<ins>giocatoreID</ins>,<ins>partitaID</ins>,gol,assist,cartellinigialli,cartellinirossi,titolare)
- tenant(<ins>TenantID</ins>,nome,password)
## MOCKUP:

**signin**

![registati](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/4a5bafa9-ebba-40c2-8f7c-6fdba5d3baac)

**login**

![log_in](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/9658821b-f331-4003-ad08-0b2966eb0eb1)

**giocatore**

![giocatore](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/adc93359-cb3d-45d3-8576-4a14e65b4dad)

**classifica**

![classifica](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/8de2d8de-c8bd-46a2-bdf5-fe5c6317cf7e)

**allenamento**

![allenamento](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/2f8fc655-9f99-4536-83fc-9a9965b4873f)

**schermata iniziale**

![schermatainiziale](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/bc596190-732b-49ed-abe1-881e9a1db06f)

**partita**

![partita](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/64fa6d81-f94b-45d5-8c09-c147b734418a)
![partite2](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/c857b1e2-0e7c-4f84-a8f8-c896b9fa57de)

**SQL**

```
DROP DATABASE IF EXISTS TeamTactiCoach;
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



INSERT INTO Squadra ( SquadraID, Categoria, Username) VALUES
( 'squadra1','Allievi', 'Username1'),
( 'squadra2','Giovanissimi', 'Username2'),
( 'squadra3','Esordienti', 'Username3');


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

```

## DATABASE SU XAMP

-    docker run --name myXampp -p 41061:22 -p 41062:80 -d -v /workspaces/TeamTactiCoach:/www tomsik68/xampp:8
- per installare composer JWT
   composer install --ignore-platform-req=ext-simplexml --ignore-platform-req=ext-fileinfo
- aprire cartella php oppure la cartella API per le api
entrare con Username1 password1
per admin entrare con Username4 password4












