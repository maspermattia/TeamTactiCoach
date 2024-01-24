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
    

    $sqlpartecipa = "DELETE FROM partecipa WHERE SquadraID = $id";
    $resultpartecipa = $conn->query($sqlpartecipa);
    
    $sqlstatistiche = "DELETE FROM statistiche WHERE SquadraID = $id";
    $resultstatistiche = $conn->query($sqlstatistiche);
    
    $sqlpartita = "DELETE FROM partita WHERE SquadraID = $id";
    $resultpartita = $conn->query($sqlpartita);
    
    $sqlgiocatore = "DELETE FROM giocatore WHERE SquadraID = $id";
    $resultgiocatore = $conn->query($sqlgiocatore);
    
    $sqlallenamento = "DELETE FROM allenamento WHERE SquadraID = $id";
    $resultallenamento = $conn->query($sqlallenamento);
    

    $sql = "DELETE FROM squadra WHERE SquadraID = $id";
    $result = $conn->query($sql);
}

$conn->close();

?>
