<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        h1 {
            margin-top: 30px;
            text-align: center;
        }
        h2 {
            margin-top: 30px;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        li {
            margin-bottom: 10px;
        }
        #response {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
<header>
    <h1>API Comandi</h1>
</header>

<h2>Token:</h2>
<p><?php echo $_GET["token"]?></p>

<h2>Comandi disponibili:</h2>
<ul>
    <li>Ricerca giocatori per nome: www/API/api/giocatori/all</li>
    <li>Ricerca squadre: www/API/api/squadre/all</li>
    <li>Ricerca utenti: www/API/api/utenti/all</li>
    <li>Ricerca allenamenti:www/API/api/allenamenti/all</li>
    <li>Valida token: www/API/validate</li>
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
