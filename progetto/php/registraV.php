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
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $ruolo = "utente";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $verifica = "SELECT * FROM AllenatoreTesserato WHERE Username='$username' OR Email='$email'"; 
    $result = $conn->query($verifica);

    if ($result->num_rows > 0) {
        echo "Username o email già esistenti. Scegliere un altro.";
    } else {
        $passcrip = md5($password);

        $sql = "INSERT INTO AllenatoreTesserato (Email, Nome, Cognome, Ruolo, Username, Password) VALUES ('$email', '$nome', '$cognome', '$ruolo', '$username', '$passcrip')";
        if ($conn->query($sql) === TRUE) {
            echo "Registrazione avvenuta con successo";
            header("Location: login.php");
        } else {
            echo "Errore nella registrazione: " . $conn->error;
        }
    }

    $conn->close();
}
?>
