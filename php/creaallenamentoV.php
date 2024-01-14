<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $squadraID=$_SESSION['squadraID'] ;
    $stmt = $conn->prepare("INSERT INTO Allenamento (SquadraID,Data) VALUES (?,?)");
    $stmt->bind_param("ss",$squadraID, $data); 

    if ($stmt->execute()) {
        header("Location: home.php");
        exit(); 
    } else {
        echo "Errore nella memorizzazione dell'allenamento: " . $stmt->error;
        header("Location: creaallenamento.php");
        exit(); 
    }

    $stmt->close();
}

$conn->close();
?>
