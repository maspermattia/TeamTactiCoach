<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "TeamTactiCoach");

$sql = "SELECT * FROM Squadra";
$result = $conn->query($sql);

$squadre = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $squadre[] = $row;
    }
}
$conn->close();


echo json_encode($squadre, JSON_PRETTY_PRINT);
?>
