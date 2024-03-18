<?php
header("Content-Type: application/json");


$conn = new mysqli("localhost", "root", "", "TeamTactiCoach");

$sql = "SELECT * FROM AllenatoreTesserato";
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
