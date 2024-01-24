<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segna Presenze</title>
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

        form {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px 0;
            color: #333;
            text-decoration: none;
        }button {
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
    </style>
</head>
<body>

<h1>Segna Presenze</h1>
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
$allenamentoID = $_GET['ID'];
$SQUADRA = $_SESSION['squadraID'];
$sql = "SELECT * FROM Giocatore WHERE SquadraID ='$SQUADRA'";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($row = $result->fetch_assoc()) {
        $giocatoreID = $row["GiocatoriID"];
        $presenza = isset($_POST['presenze'][$giocatoreID]) ? $_POST['presenze'][$giocatoreID] : '0';
        $sql = "INSERT INTO Partecipa (GiocatoreID, AllenamentoID, Presenza) VALUES ('$giocatoreID', '$allenamentoID', '$presenza')";
        $conn->query($sql);
    }
    header("Location: presenze.php"); 
    exit();
}

if ($result->num_rows > 0) {
    echo "<form method='post'>";
    while ($row = $result->fetch_assoc()) {
        echo "<label>" . $row["Nickname"] . "</label>";
        echo "<input type='checkbox' name='presenze[" . $row["GiocatoriID"] . "]' value='1'>";
        echo "<br>";
    }
    echo "<input type='submit' value='Invia'>";
    echo "</form>";
} else {
    echo "Nessun risultato trovato.";
}

$conn->close();
?>

<a href="presenze.php"><button>Torna a presenze</button></a>

</body>
</html>