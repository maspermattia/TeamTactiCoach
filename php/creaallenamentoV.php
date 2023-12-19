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
    $squadraID = $_SESSION['squadraID'];
    $verificadata = "SELECT * FROM Allenamento WHERE Data='$data' AND SquadraID='$squadraID'";
    $verificadata = $conn->query($verificadata);

    if ($verificadata->num_rows > 0) {
        echo "è già presente un allenamento in questa data";
        header("Location: creaallenamento.php");
    } else {
        // Inserisci la partita nella tabella Partita
        $stmt = $conn->prepare("INSERT INTO Allenamento (Data) VALUES (?)");
        $stmt->bind_param("is",$data);

        if ($stmt->execute()) {
            header("Location: home.php");
        } else {
            echo "errore nella memorizzazione dell'allenamento: " . $stmt->error;
            header("Location: creaallenamento.php");
        }

        $stmt->close();
    }
}

$conn->close();
?>
