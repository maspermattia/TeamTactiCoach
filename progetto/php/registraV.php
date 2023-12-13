<?php
// Connessione al database 
$servename = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servename, $username, $password, $dbname);

// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Registrazione utente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $password = $_POST["password"];
    $dataDiNascita = $_POST["dataDiNascita"];
    $mail = $_POST["mail"];
   

    // Verifica se il nome,email esistono già nel database
    $verifica = "SELECT * FROM Utente WHERE Username='$username' AND Mail='$mail'";
    $result = $conn->query($verifica);

    if ($result->num_rows > 0) {
        echo "Errore: Il nome utente '$username' o l'indirizzo email '$mail' sono già in uso ";
    } else {
        
                }
            // Hash della password con md5
                $hashPassword = md5($password);

                // Inserimento dati nel database
                $sql = "INSERT INTO Utente (Username, Nome, Cognome, Password, DataDiNascita,Mail) 
                    VALUES ('$username', '$nome', '$cognome', '$hashPassword', '$dataDiNascita', '$mail')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registrazione avvenuta con successo";
                    header("Location: Login.php");
                    exit();
                } else {
                    echo "Errore: " . $sql . "<br>" . $conn->error;
                }
     }  
      


// Chiudi connessione database
$conn->close();

// Esci dallo script
exit();
?>