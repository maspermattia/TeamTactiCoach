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

    $sql = "DELETE FROM allenamento WHERE AllenamentoID = $id";
    $result = $conn->query($sql);
    if($result){
        echo "success";
    }else{
        echo "fail";
    }
    $sqlpartecipa = "DELETE FROM partecipa WHERE AllenamentoID = $id";
    $resultpartecipa = $conn->query($sqlpartecipa);
    if($resultpartecipa){
        echo "success";
    }else {
        echo "fail";
    }
}

$conn->close();

?>