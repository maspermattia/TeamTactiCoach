<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Allenamenti</title>
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

<h1>Elenco Allenamenti</h1>

<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    session_destroy();
    exit();
}
$SQUADRA = $_SESSION['squadraID'];
$sql = "SELECT * FROM Allenamento WHERE squadraID ='$SQUADRA'";
$result = $conn->query($sql);
$incremento = 1;
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>numero Allenamento</th>
                <th>Data</th>
                <th>Segna Presenze</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td> $incremento </td>
                <td>" . $row["Data"] . "</td>
                <td><a href='segnapresenze.php?ID=".$row["AllenamentoID"]."'><button>Segna Presenze</button></a></td>
              </tr>";
              $incremento++;
    }

    echo "</table>";
} else {
   
}

$conn->close();
?>

<a href="home.php"><button>Torna a home</button></a>

</body>
</html>
