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
    $stmt->bind_result($username);
    $stmt->bind_result($ruolo);

    if ($stmt->fetch()) {
    
        $_SESSION['username'] = $Username;
        $_SESSION["ruolo"] = $ruolo;

      
        if ($ruolo == "admin") {
            header("Location: homeadmin.php");
        } else {
            header("Location: creasquadra.php");
        }
        exit();
    } else {
        echo "Errore: Nome utente o password non validi.";
    }


}
$conn->close();

?>