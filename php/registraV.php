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
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $ruolo = $_POST["ruolo"];;
    
    $verificaUsername = "SELECT * FROM AllenatoreTesserato WHERE Username='$username'";
    $verificaEmail = "SELECT * FROM AllenatoreTesserato WHERE Email='$email'";
    
    $resultUsername = $conn->query($verificaUsername);
    $resultEmail = $conn->query($verificaEmail);

    if ($resultUsername->num_rows > 20) {
        echo "Username già esistente. Scegliere un altro.";
        header("Location: registra.php");
    } elseif ($resultEmail->num_rows > 20) {
        echo "Email già esistente. Scegliere un'altra.";
        header("Location: registra.php");
    } else {
        $passcrip = md5($password);

        $sql = "INSERT INTO AllenatoreTesserato (Email, Nome, Cognome, Ruolo, Username, Password) VALUES ('$email', '$nome', '$cognome', '$ruolo', '$username', '$passcrip')";
        if ($conn->query($sql) === TRUE) {
            echo "Registrazione avvenuta con successo";
            header("Location: login.php");
        } else {
            echo "Errore nella registrazione: " . $conn->error;
            header("Location: registra.php");
        }
    }

    $conn->close();
}
?>
