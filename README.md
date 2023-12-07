# TeamTactiCoach

**PROBLEMA**
visualizzare tutti i dati che un allenatore prende su carta, in maniera digitale e ottimizzare la visualizzazione

## FUNZIONALITÀ:

**Registrazione Utente:**
- Registra Utente: Permette agli utenti di registrarsi inserendo il nome della squadra e altre informazioni pertinenti.
- Elimina Utente: Consente agli utenti di eliminare il proprio account, cancellando tutte le informazioni associate.

**Giocatori:**
- Aggiungi Giocatore: Permette agli utenti di inserire nuovi giocatori nella lista della squadra.
- Modifica Dati Giocatore: Consente agli utenti di aggiornare le informazioni sui giocatori, come nome, gol, assist, cartellini gialli e rossi, ecc.
- Elimina Giocatore: Permette agli utenti di rimuovere un giocatore dalla squadra.

**Gestione delle partite:**
- Crea Partita: Permette agli utenti di creare e pianificare nuove partite, assegnando i titolari e impostare la data.
- Modifica Partita: Consente agli utenti di apportare modifiche alle partite già programmate, come cambiare data o avversario.
- Registra Risultati: Consente agli utenti di inserire i risultati delle partite, compresi gol, assist, e cartellini gialli/rossi.

**Gestione allenamenti:**
- permette di mettere assente o presente un giocatore e impostare la data di allenamento
  
**Classifica:**
- Visualizza Classifica: Permette agli utenti di visualizzare la classifica aggiornata.

## SCHEMA E - R:
![schema_er.png](https://github.com/maspermattia/TeamTactiCoach/blob/d998454b18082c49d6cf0947ebb508281b9570e1/schema_er.png)


## SCHEMA RELAZIONALE:

- squadra(<ins>squadraID</ins>,categoria)
- allenatoretesserato(<ins>userID</ins>,squadraID,email,password)
- partita(<ins>partitaID</ins>,data,risultato,avversario,squadraID)
- giocatore(<ins>giocatoriID</ins>,squadraID,nickname)
- allenamento(<ins>allenamentoID</ins>,data)
- partecipa(<ins>giocatoreID</ins>,<ins>allenamentoID</ins>,presenza)
- statistiche(<ins>giocatoreID</ins>,<ins>partitaID</ins>,gol,assist,cartellinigialli,cartellinirossi,titolare)

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
CREATE DATABASE IF NOT EXISTS  calcio;
USE calcio;
 
CREATE TABLE IF NOT EXISTS Squadra (
    SquadraID INT PRIMARY KEY ,
    Categoria VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS AllenatoreTesserato (
    UserID INT PRIMARY KEY,
    SquadraID INT  REFERENCES Squadra(SquadraID),
    Email VARCHAR(255),
    Password VARCHAR(255)
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
    Presenza BOOLEAN<br>
);

CREATE TABLE IF NOT EXISTS Statistiche (<br>
    GiocatoreID INT  REFERENCES Giocatore(GiocatoreID),  
    PartitaID INT  REFERENCES Partita(PartitaID),
    PRIMARY KEY(GiocatoreID,PartitaID),
    Gol INT,<br>
    Assist INT,<br>
    CartelliniGialli INT,
    CartelliniRossi INT,
    Titolare BOOLEAN
);










