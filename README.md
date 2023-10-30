# TeamTactiCoach

**PROBLEMA**
visualizzare tutti i dati che un allenatore prende su carta, in maniera digitale e ottimizzare la visualizzazione

## FUNZIONALITÀ:##

**Registrazione Utente:**
- Registra Utente: Permette agli utenti di registrarsi inserendo il nome della squadra e altre informazioni pertinenti.
- Elimina Utente: Consente agli utenti di eliminare il proprio account, cancellando tutte le informazioni associate.

**Giocatori:**
- Aggiungi Giocatore: Permette agli utenti di inserire nuovi giocatori nella lista della squadra.
- Modifica Dati Giocatore: Consente agli utenti di aggiornare le informazioni sui giocatori, come nome, gol, assist, cartellini gialli e rossi, ecc.
- Elimina Giocatore: Permette agli utenti di rimuovere un giocatore dalla squadra.

**Gestione delle partite:**
- Crea Partita: Permette agli utenti di creare e pianificare nuove partite, assegnando i titolari e impostare la data.
- Modifica Partita: Consente agli utenti di apportare modifiche alle partite già programmate, come cambiare data, avversario o luogo.
- Registra Risultati: Consente agli utenti di inserire i risultati delle partite, compresi gol, assist, e cartellini gialli/rossi.

**Gestione allenamenti:**
- permette di mettere assente o presente un giocatore e impostare la data di allenamento
  
**Classifica:**
- Visualizza Classifica: Permette agli utenti di visualizzare la classifica aggiornata.

## SCHEMA E-R:##
![schema_er](https://github.com/maspermattia/TeamTactiCoach/assets/101709283/4fc48bda-89d1-4808-91ca-951bbfa2fca2)


## SCHEMA RELAZIONALE:##

- squadra(<ins>squadraID</ins>,punti,nomesquadra,giocatoreID,partitaID,userID,data)
- classifica(<ins>classificaID</ins>,cartellinigialli,assenze,cartellinirossi,assist,gol,nickname)
- allenatoretesserato(<ins>userID</ins>,categoria,nomeutente,password)
- partita(<ins>partitaID</ins>,avversario,titolari,gol,assist,giocatoreID,cartellinirossi,cartellinigialli)
- giocatore(<ins>giocatoriID</ins>,cartellinigialli,assenze,cartellinirossi,assist,gol,nickname)
- allenamento(<ins>allenamentoID</ins>,<ins>giocatoreID</ins>,presente,data)
- partecipa(data_k,giocatoreID,allenamentoID)

