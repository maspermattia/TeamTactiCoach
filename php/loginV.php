<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["username"];
    $password = $_POST["password"];
    $passcrip = md5($password);

    
    $sql = "SELECT Ruolo FROM AllenatoreTesserato WHERE Username=? AND Password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $Username, $passcrip);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($ruolo);
        $stmt->fetch();

        
        $sql_squadra = "SELECT SquadraID FROM Squadra WHERE Username=?";
        $stmt_squadra = $conn->prepare($sql_squadra);
        $stmt_squadra->bind_param("s", $Username);
        $stmt_squadra->execute();
        $stmt_squadra->store_result(); 

        if ($stmt_squadra->num_rows > 0) {
            $stmt_squadra->bind_result($squadraID);
            $stmt_squadra->fetch();

           
            $_SESSION['username'] = $Username;
            $_SESSION['ruolo'] = $ruolo;
            $_SESSION['squadraID'] = $squadraID;

            if ($ruolo == "admin") {
                header("Location: homeadmin.php");
            } else {
                header("Location: creasquadra.php");
            }
            exit();
        } else {
            $_SESSION['username'] = $Username;
            $_SESSION['ruolo'] = $ruolo;
            if ($ruolo == "admin") {
                header("Location: homeadmin.php");
            } else {
                header("Location: creasquadra.php");
            }
            exit();
        }

        $stmt_squadra->close();
    } else {
        echo "Errore: Nome utente o password non validi.";
    }

    $stmt->close();
}

$conn->close();
?>
