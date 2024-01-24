<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM partita WHERE PartitaID = $id";
    $result = $conn->query($sql);
    $sqlstatistiche = "DELETE FROM statistiche WHERE PartitaID = $id";
    $resultstatistiche = $conn->query($sqlstatistiche);
   
    
}

$conn->close();

?>
