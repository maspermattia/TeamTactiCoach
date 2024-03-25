<?php
header("Content-Type: application/json");

$playerName = isset($_GET['playerName']) ? $_GET['playerName'] : null;

$conn = new mysqli("localhost", "root", "", "TeamTactiCoach");

$sql = "SELECT * FROM AllenatoreTesserato";
if ($playerName && $playerName !== 'all') {
    $sql .= " WHERE UserID = '$playerName'";
}

$result = $conn->query($sql);

$utenti = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $utenti[] = $row;
    }
}

$conn->close();

echo json_encode($utenti, JSON_PRETTY_PRINT);
?>
