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
$_SESSION["id"] = $conn->insert_id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $squadraID = $_POST["squadraID"];
    $categoria = $_POST["categoria"];

    // Assicurati di avere l'ID dell'utente dalla sessione
    $allenatoreID = $_SESSION["UserID"];

    // Verifica se l'utente ha già una squadra
    $verificaSquadraUtente = "SELECT * FROM Squadra WHERE UserID='$allenatoreID'";
    $resultSquadraUtente = $conn->query($verificaSquadraUtente);

    if ($resultSquadraUtente->num_rows > 0) {
        echo "L'utente ha già una squadra. Non è possibile creare una nuova squadra.";
        header("Location: creasquadra.php");
    } else {
        // Inserisci la squadra nel database utilizzando uno statement preparato
        $stmt = $conn->prepare("INSERT INTO Squadra (SquadraID, Categoria, UserID) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $squadraID, $categoria, $allenatoreID);

        if ($stmt->execute()) {
            echo "Registrazione squadra avvenuta con successo";
            header("Location: home.php");
        } else {
            echo "Errore nella registrazione della squadra: " . $stmt->error;
            header("Location: creasquadra.php");
        }

        $stmt->close();
    }
}

$conn->close();
?>
