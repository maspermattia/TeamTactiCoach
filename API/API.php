<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandi</title>
    <style>
        #response {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<h2>Comandi disponibili:</h2>
<ul>
    <li>Ricerca giocatori per nome: <a href="http://localhost/infomasper/API/api/giocatori/all">http://localhost/infomasper/API/api/giocatori</a></li>
    <li>Ricerca squadre: <a href="http://localhost/infomasper/API/api/squadre/all">http://localhost/infomasper/API/api/squadre</a></li>
    <li>Ricerca utenti: <a href="http://localhost/infomasper/API/api/utenti/all">http://localhost/infomasper/API/api/utenti</a></li>
    <li>Ricerca allenamenti: <a href="http://localhost/infomasper/API/api/allenamenti/all">http://localhost/infomasper/API/api/allenamenti</a></li>
</ul>

<div id="response"></div>

<script>
    function getJSONData(url) {
        fetch(url)
            .then(response => response.json())
            .then(data => displayData(data))
            .catch(error => console.error('Errore:', error));
    }


    const urlParams = new URLSearchParams(window.location.search);
    const playerName = urlParams.get('playerName');

   
    if (playerName) {
        getJSONData(`http://localhost/infomasper/API/api/giocatori/${playerName}`);
    }
</script>
</body>
</html>
