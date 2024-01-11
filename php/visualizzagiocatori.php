<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Giocatori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Elenco Giocatori</h1>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}


$sql = "SELECT * FROM Giocatore";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>ID Giocatore</th>
                <th>ID Squadra</th>
                <th>Nickname</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["GiocatoriID"] . "</td>
                <td>" . $row["SquadraID"] . "</td>
                <td>" . $row["Nickname"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nessun risultato trovato.";
}


$conn->close();
?>


<a href="homeadmin.php"><button>Torna a home</button></a>

</body>
</html>
