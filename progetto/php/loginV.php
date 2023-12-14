<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Funzione per verificare l'autenticità dell'utente
function verificaAutenticita($conn, $username, $password) {
    // Utilizza le query parametrizzate per evitare SQL injection
    $verifica = "SELECT * FROM AllenatoreTesserato WHERE Username=? AND Password=?";
    $stmt = $conn->prepare($verifica);
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    if (verificaAutenticita($conn, $username, $password)) {
        // Ottieni il ruolo dell'utente
        $ruoloQuery = "SELECT Ruolo FROM AllenatoreTesserato WHERE Username=?";
        $stmt = $conn->prepare($ruoloQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($ruolo);
        $stmt->fetch();

        // Inizializza la sessione
        session_start();

        // Memorizza l'username e il ruolo nella sessione
        $_SESSION["username"] = $username;
        $_SESSION["ruolo"] = $ruolo;

        // Reindirizza in base al ruolo
        if ($ruolo == "admin") {
            header("Location: homeadmin.php");
        } else {
            header("Location: Home.php");
        }
        exit();
    } else {
        echo "Errore: Nome utente o password non validi.";
        header("Location: login.php");
    }
}

// Chiudi connessione database
$conn->close();
?>