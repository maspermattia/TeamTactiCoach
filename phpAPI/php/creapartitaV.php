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
    session_destroy();
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avversario = $_POST["avversario"];
    $risultato = $_POST["risultato"];
    $data = $_POST["data"];
    $squadraID=$_SESSION['squadraID'] ;
    $verificadata = "SELECT * FROM Partita WHERE Data='$data' AND SquadraID='$squadraID'";
    $verificadata = $conn->query($verificadata);

    if ($verificadata->num_rows > 0) {
        echo "è gia presente una partita in questa data";
       
    } else {
        
        $stmt = $conn->prepare("INSERT INTO Partita (SquadraID, Avversario, Risultato, Data) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $squadraID, $avversario, $risultato, $data);
        
        if ($stmt->execute()) {
            header("Location: home.php");
        } else {
            echo "errore nella memorizzazione della partita: " ;
            
        }

        $stmt->close();
    }
}

$conn->close();
?>
