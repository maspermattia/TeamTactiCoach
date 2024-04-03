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
<h1>TOKEN</h1>
<p><?php echo $_GET["token"]?></p>
<h2>Comandi disponibili:</h2>
<ul>
    <li>Ricerca giocatori per nome: www/API/api/giocatori/all
    <li>Ricerca squadre: www/API/api/squadre/all
    <li>Ricerca utenti: www/API/api/utenti/all
    <li>Ricerca allenamenti: www/API/api/allenamenti/all
    <li>Valida token: www/API/validate
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
