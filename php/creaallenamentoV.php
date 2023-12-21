<?php
session_start(); // Assicurati di iniziare la sessione

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $squadraID=$_SESSION['squadraID'] ;
    $stmt = $conn->prepare("INSERT INTO Allenamento (SquadraID,Data) VALUES (?,?)");
    $stmt->bind_param("ss",$squadraID, $data); // "s" indica che si tratta di una stringa

    if ($stmt->execute()) {
        header("Location: home.php");
        exit(); // Aggiunto exit() per evitare esecuzione successiva
    } else {
        echo "Errore nella memorizzazione dell'allenamento: " . $stmt->error;
        header("Location: creaallenamento.php");
        exit(); // Aggiunto exit() per evitare esecuzione successiva
    }

    $stmt->close();
}

$conn->close();
?>