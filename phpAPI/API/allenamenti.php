<?php
header("Content-Type: application/json");

$playerName = isset($_GET['playerName']) ? $_GET['playerName'] : null;

$conn = new mysqli("localhost", "root", "", "TeamTactiCoach");

$sql = "SELECT * FROM Allenamento";
if ($playerName && $playerName !== 'all') {
    $sql .= " WHERE AllenamentoID = '$playerName'";
}

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
