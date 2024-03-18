<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}


$sql = "SELECT * FROM Giocatore";
$result = $conn->query($sql);

$giocatori = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $giocatori[] = $row;
    }
}

$conn->close();

echo json_encode($giocatori, JSON_PRETTY_PRINT);
?>