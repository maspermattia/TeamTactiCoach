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
    if($result){
        echo "success";
    }else {
        echo "fail";
    }
    $sqlstatistiche = "DELETE FROM statistiche WHERE GiocatoreID = $id"; 
    $resultstatistiche = $conn->query($sqlstatistiche);
    if($resultstatistiche){
        echo "success";
    }else {
        echo "fail";
    }
    $sqlpartecipa = "DELETE FROM partecipa WHERE GiocatoreID = $id";
    $resultpartecipa = $conn->query($sqlpartecipa);
    if($resultpartecipa){
        echo "success";
    }else {
        echo "fail";
    }

}
    


$conn->close();

?>