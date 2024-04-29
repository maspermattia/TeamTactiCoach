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
    $nome = $_POST["nome"];

    
    $verificaUsername = "SELECT * FROM AllenatoreTesserato WHERE Username='$username'";
    $verificaemail = "SELECT * FROM AllenatoreTesserato WHERE email='$email'";
    
    $resultUsername = $conn->query($verificaUsername);
    $resultEmail = $conn->query($verificaemail);

    if ($resultUsername->num_rows > 0) {
       
        echo "Username già esistente. Scegliere un altro.";
        
    } else if ($resultEmail->num_rows > 0) {
        echo "Email già esistente. Scegliere un'altra.";
       
    } else {
        $passcrip = md5($password);

      
        $verificaTenant = "SELECT * FROM Tenant WHERE nome='$nome'";
        $resultTenant = $conn->query($verificaTenant);

        if ($resultTenant->num_rows > 0) {
            $sql = "INSERT INTO AllenatoreTesserato (email, Nome, Cognome, Ruolo, Username,DataNascita, Password,nome) VALUES ('$email', '$nome', '$cognome', '$ruolo', '$username','$DataNascita' ,'$passcrip','$nome')";
            if ($conn->query($sql) === TRUE) {
                echo "Registrazione avvenuta con successo";
                header("Location: login.php");
            } else {
                echo "Errore nella registrazione: " . $conn->error;
               
            }
        } else {
            echo "Il nome tenant specificato non esiste.";
           
        }
    }
}
$conn->close();
?>
