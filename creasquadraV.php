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
    $squadraID = $_POST["squadraID"];
    $categoria = $_POST["categoria"];
    
    
    $Username=$_SESSION['username'];
    
  
    $verificaSquadraUtente = "SELECT * FROM Squadra WHERE Username='$Username'";
    $resultSquadraUtente = $conn->query($verificaSquadraUtente);

    if ($resultSquadraUtente->num_rows > 0) {
        echo "L'utente ha già una squadra. Non è possibile creare una nuova squadra.";
        header("Location: creasquadra.php");
    } else {
        
        $stmt = $conn->prepare("INSERT INTO Squadra (SquadraID, Categoria, Username) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $squadraID, $categoria, $Username);
        $_SESSION['squadraID'] = $squadraID;
        if ($stmt->execute()) {
            header("Location: home.php");
        } else {
            echo "Errore nella registrazione della squadra: " ;
            header("Location: creasquadra.php");
        }

        $stmt->close();
    }
}

$conn->close();
?>
