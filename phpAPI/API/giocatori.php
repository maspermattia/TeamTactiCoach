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

$playerName = isset($_GET['playerName']) ? $_GET['playerName'] : null;

$sql = "SELECT * FROM Giocatore";
if ($playerName && $playerName !== 'all') {
    $sql .= " WHERE GiocatoriID = '$playerName'";
}

$result = $conn->query($sql);

$players = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $players[] = $row;
    }
} elseif ($playerName === 'all') {
    $sql = "SELECT * FROM Giocatore";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $players[] = $row;
        }
    }
}

$conn->close();

echo json_encode($players, JSON_PRETTY_PRINT);
?>
