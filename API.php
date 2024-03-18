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
    <li>Ricerca giocatori <a href="http://localhost/infomasper/php/api/giocatori">http://localhost/infomasper/php/api/giocatori</a></li>
    <li>Ricerca squadre: <a href="http://localhost/infomasper/php/api/squadre">http://localhost/infomasper/php/api/squadre</a></li>
    <li>Ricerca utenti: <a href="http://localhost/infomasper/php/api/utenti">http://localhost/infomasper/php/api/utenti</a></li>
    <li>Ricerca allenamenti: <a href="http://localhost/infomasper/php/api/allenamenti">http://localhost/infomasper/php/api/allenamenti</a></li>
</ul>

<div id="response"></div>

<script>
    function getJSONData(url) {
        fetch(url)
            .then(response => response.json())
            .then(data => displayData(data))
            .catch(error => console.error('Errore:', error));
    }
    const queryParams = new URLSearchParams(window.location.search);
    const endpoint = queryParams.get('giocatori') || queryParams.get('squadre') || queryParams.get('utenti') || queryParams.get('allenamenti');
    if (endpoint) {
        getJSONData(`http://localhost/infomasper/api/${endpoint}`);
    }
</script>
</body>
</html>
