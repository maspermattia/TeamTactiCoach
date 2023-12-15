<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passcrip = md5($password);

    // Utilizza le query parametrizzate per evitare SQL injection
    $sql = "SELECT Ruolo FROM AllenatoreTesserato WHERE Username=? AND Password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $passcrip);
    $stmt->execute();
    $stmt->bind_result($ruolo);

    if ($stmt->fetch()) {
        // Inizializza la sessione
        session_start();

        // Memorizza l'username e il ruolo nella sessione
        $_SESSION["username"] = $username;
        $_SESSION["ruolo"] = $ruolo;

        // Reindirizza in base al ruolo
        if ($ruolo == "admin") {
            header("Location: homeadmin.php");
        } else {
            header("Location: creasquadra.php");
        }
        exit();
    } else {
        echo "Errore: Nome utente o password non validi.";
    }

    $stmt->close();
}

$conn->close();
?>