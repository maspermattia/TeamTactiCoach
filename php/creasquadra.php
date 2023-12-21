<?php
session_start(); // Assicurati di iniziare la sessione

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$Username = $_SESSION['username'];
$SquadraID_query = "SELECT SquadraID FROM Squadra WHERE Username='$Username'";
$resultSquadraID = $conn->query($SquadraID_query);

if ($resultSquadraID) {
    $row = $resultSquadraID->fetch_assoc();
    $_SESSION['squadraID'] = $SquadraID_query;
} else {
    echo "Errore nella query: " . $conn->error;
}

$verificaSquadraUtente_query = "SELECT * FROM Squadra WHERE Username='$Username'";
$resultSquadraUtente = $conn->query($verificaSquadraUtente_query);

if ($resultSquadraUtente->num_rows > 0) {
    header("Location: home.php");
    exit(); 
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Squadra</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 20px;
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Crea Squadra</h2>
        <form method="post" action="creasquadraV.php">
            <div class="form-group">
                <label for="squadraID">Nome Squadra:</label>
                <input type="text" name="squadraID" required>
            </div>
            <div class="form-group">
    <label for="categoria">Categoria:</label>
    <select name="categoria" required>
        <option value="Juniores">Juniores</option>
        <option value="Allievi">Allievi</option>
        <option value="Giovanissimi">Giovanissimi</option>
        <option value="Esordienti">Esordienti</option>
        <option value="Pulcini">Pulcini</option>
    </select>
</div>
    <button type="submit">Crea Squadra</button>
        </form>
    </div>
</body>

</html>
