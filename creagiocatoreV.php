<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    session_destroy();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nickname = $_POST["Nickname"];
    $Username = $_SESSION['username'];
    $squadraID = $_SESSION['squadraID'];

    $verificaNicknameGiocatore = "SELECT * FROM Giocatore WHERE Nickname='$Nickname' AND SquadraID='$squadraID'";
    $verificaNicknameGiocatore = $conn->query($verificaNicknameGiocatore);

    if ($verificaNicknameGiocatore->num_rows > 0) {
        
        
    } else {
        $stmt = $conn->prepare("INSERT INTO Giocatore (SquadraID, Nickname) VALUES (?, ?)");
        $stmt->bind_param("ss", $squadraID, $Nickname);

        if ($stmt->execute()) {
            
            $nuovoGiocatoreID = $stmt->insert_id;

        
            $nuovoGiocatoreHTML = "<tr>
                                    <td>" . $nuovoGiocatoreID . "</td>
                                    <td>" . $Nickname . "</td>
                                  </tr>";

            
            echo $nuovoGiocatoreHTML;
            alert("fatto");
        } else {
            header("Location: creagiocatore.php");
        }

        $stmt->close();
    }
}

$conn->close();
?>
