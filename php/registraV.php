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
    $DataNascita = $_POST["DataNascita"];
    $ruolo = $_POST["ruolo"];
    $TenantID = $_POST["TenantID"];

    
    $verificaUsername = "SELECT * FROM AllenatoreTesserato WHERE Username='$username'";
    $verificaemail = "SELECT * FROM AllenatoreTesserato WHERE email='$email'";
    
    $resultUsername = $conn->query($verificaUsername);
    $resultEmail = $conn->query($verificaemail);

    if ($resultUsername->num_rows > 0) {
        header("Location: registra.php");
        echo "Username già esistente. Scegliere un altro.";
        
    } else if ($resultEmail->num_rows > 0) { // Correggi qui
        echo "Email già esistente. Scegliere un'altra.";
        header("Location: registra.php");
    } else {
        $passcrip = md5($password);

        // Controlla se il TenantID esiste nella tabella tenant
        $verificaTenant = "SELECT * FROM Tenant WHERE TenantID='$TenantID'";
        $resultTenant = $conn->query($verificaTenant);

        if ($resultTenant->num_rows > 0) {
            $sql = "INSERT INTO AllenatoreTesserato (email, Nome, Cognome, Ruolo, Username,DataNascita, Password,TenantID) VALUES ('$email', '$nome', '$cognome', '$ruolo', '$username','$DataNascita' ,'$passcrip','$TenantID')";
            if ($conn->query($sql) === TRUE) {
                echo "Registrazione avvenuta con successo";
                header("Location: login.php");
            } else {
                echo "Errore nella registrazione: " . $conn->error;
                header("Location: registra.php");
            }
        } else {
            echo "Il TenantID specificato non esiste.";
            header("Location: registra.php");
        }
    }
}
$conn->close();
?>
