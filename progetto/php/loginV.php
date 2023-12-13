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
    $verifica = "SELECT * FROM allenatoretesserato WHERE username=? AND password=?";
    $stmt = $conn->prepare($verifica);
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifica se l'utente esiste nel database
    if (verificaAutenticita($conn, $username, $password)) {
        // Inizializza la sessione
        session_start();

        // Memorizza l'username nella sessione
        $_SESSION["username"] = $username;

        // Reindirizza alla home
        header("Location: Home.php");
        exit();
    } else {
        echo "Errore: Nome utente o password non validi.";
    }
}

// Chiudi connessione database
$conn->close();
?>