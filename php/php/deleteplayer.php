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

    $sql = "DELETE FROM Giocatore WHERE GiocatoriID = $id";
    $result = $conn->query($sql);
    $sqlstatistiche = "DELETE FROM statistiche WHERE GiocatoreID = $id"; 
    $resultstatistiche = $conn->query($sqlstatistiche);
    $sqlpartecipa = "DELETE FROM partecipa WHERE GiocatoreID = $id";
    $resultpartecipa = $conn->query($sqlpartecipa);

}
    


$conn->close();

?>