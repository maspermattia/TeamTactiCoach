<?php
header("Content-Type: application/json");


$conn = new mysqli("localhost", "root", "", "TeamTactiCoach");

$sql = "SELECT * FROM Allenamento";
$result = $conn->query($sql);

$allenamenti = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $allenamenti[] = $row;
    }
}


$conn->close();


echo json_encode($allenamenti, JSON_PRETTY_PRINT);
?>
