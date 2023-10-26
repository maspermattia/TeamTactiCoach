# TeamTactiCoach

FUNZIONALITÀ:

Registrazione Utente:

Registra Utente: Permette agli utenti di registrarsi inserendo il nome della squadra e altre informazioni pertinenti.
Elimina Utente: Consente agli utenti di eliminare il proprio account, cancellando tutte le informazioni associate.
Modifica utente: modifica l'utente

Inserimento Giocatori:

Aggiungi Giocatore: Permette agli utenti di inserire nuovi giocatori nella lista della squadra.
Modifica Dati Giocatore: Consente agli utenti di aggiornare le informazioni sui giocatori, come nome, gol, assist, cartellini gialli e rossi, ecc.
Elimina Giocatore: Permette agli utenti di rimuovere un giocatore dalla squadra.

Gestione delle partite:

Crea Partita: Permette agli utenti di creare e pianificare nuove partite, assegnando i titolari.
Modifica Partita: Consente agli utenti di apportare modifiche alle partite già programmate, come cambiare data, avversario o luogo.
Registra Risultati: Consente agli utenti di inserire i risultati delle partite, compresi gol, assist, e cartellini gialli/rossi.

Statistiche dei Giocatori:

Calcola Statistiche Giocatore: Calcola automaticamente le statistiche dei giocatori in base alle informazioni raccolte, come gol segnati, assist, presenze, ecc.
Visualizza Statistiche Giocatore: Permette agli utenti di visualizzare le statistiche dettagliate di ogni giocatore.

Classifica:

Calcola Classifica: Calcola la classifica generale sulla base dei giocatori e delle loro statistiche.
Visualizza Classifica: Permette agli utenti di visualizzare la classifica aggiornata.

PROBLEMI

Inserimento Giocatori:

Errore nei dati: Gli utenti potrebbero inserire dati errati o incompleti sui giocatori.

Gestione delle Partite:

Registrazione dei risultati: Errori nella registrazione dei risultati delle partite potrebbero influenzare la classifica e le statistiche complessive.

Classifica:

Pari merito: In caso di parità di punti o di altre statistiche, potrebbe essere difficile determinare una classifica precisa, causando potenziali dispute.


SCHEMA RELAZIONALE:
k=chiaveprimaria

squadra(squadraIDk,punti,nomesquadra,giocatoreID,partitaID,userID)

classifica(classificaIDk,cartellinigialli,assenze,cartellinirossi,assist,gol,nickname,giocatoreID)

allenatoretesserato(USERIDk,categoria,nomeutente,password)

partita(PartitaIDk,avversario,titolari,gol,assist,giocatoreID,cartellinirossi,cartellinigialli)

giocatore(giocatoriIDk,cartellinigialli,assenze,cartellinirossi,assist,gol,nickname)

allenamento(allenamentoID,giocatoreID,presente)

partecipa(datak,giocatoreID,allenamentoID)


