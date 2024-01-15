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
$userID = $_SESSION['username'];


$result = $conn->query("SELECT SquadraID FROM Squadra WHERE username = '$userID'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $squadraIDUtente = $row["SquadraID"];
} else {
    
    echo "Errore: Nessuna squadra trovata per l'allenatore.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $giocatoreID = mysqli_real_escape_string($conn, $_POST["giocatore"]);
    $partitaID = mysqli_real_escape_string($conn, $_POST["partita"]);
    $checkExistingStats = $conn->query("SELECT * FROM Statistiche WHERE GiocatoreID = '$giocatoreID' AND PartitaID = '$partitaID'");

    if ($checkExistingStats->num_rows > 0) {
        echo "Errore: Il giocatore ha già delle statistiche per la partita selezionata.";
        exit();
    }
    $gol = mysqli_real_escape_string($conn, $_POST["gol"]);
    $assist = mysqli_real_escape_string($conn, $_POST["assist"]);
    $cartelliniGialli = mysqli_real_escape_string($conn, $_POST["cartellini_gialli"]);
    $cartelliniRossi = mysqli_real_escape_string($conn, $_POST["cartellini_rossi"]);
    $titolare = isset($_POST["titolare"]) ? 1 : 0;


 
    if ($cartelliniGialli > 2 || $cartelliniRossi > 1) {
        echo "Errore: Il numero massimo di cartellini gialli è 2 e il numero massimo di cartellini rossi è 1.";
        exit();
    }


    if ($cartelliniGialli > 1 && $cartelliniRossi > 0) {
        echo "Errore: Non è possibile avere due cartellini gialli insieme a uno rosso.";
        exit();
    }

    
    $sql = "INSERT INTO Statistiche (GiocatoreID, PartitaID, SquadraID, Gol, Assist, CartelliniGialli, CartelliniRossi, Titolare) 
            VALUES ('$giocatoreID', '$partitaID', '$squadraIDUtente', '$gol', '$assist', '$cartelliniGialli', '$cartelliniRossi', '$titolare')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: home.php");
        exit();
    } else {
        echo "Errore durante l'aggiunta delle statistiche: " . $conn->error;
    }
}

$giocatoriResult = $conn->query("SELECT GiocatoriID, Nickname FROM Giocatore WHERE SquadraID = '$squadraIDUtente'");
$partiteResult = $conn->query("SELECT PartitaID, Avversario FROM Partita WHERE SquadraID = '$squadraIDUtente'");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Statistiche</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 6px;
            font-weight: bold;
            color: #555;
        }

        select,
        input {
            width: calc(100% - 24px);
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="checkbox"] {
            margin-top: 6px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .logout {
            position: absolute;
            top: 20px;
            right: 130px;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: 1px solid #ffeead;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #45a049;
        }

        .logout a:hover {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Aggiungi Statistiche</h2>

        <label for="giocatore">Giocatore:</label>
        <select name="giocatore">
            <?php
            while ($row = $giocatoriResult->fetch_assoc()) {
                echo "<option value='{$row['GiocatoriID']}'>{$row['Nickname']}</option>";
            }
            ?>
        </select>

        <label for="partita">Partita:</label>
        <select name="partita">
            <?php
            while ($row = $partiteResult->fetch_assoc()) {
                echo "<option value='{$row['PartitaID']}'>{$row['Avversario']}</option>";
            }
            ?>
        </select>

        <label for="gol">Gol:</label>
<input type="number" name="gol" min="0">

<label for="assist">Assist:</label>
<input type="number" name="assist" min="0">

<label for="cartellini_gialli">Cartellini Gialli:</label>
<input type="number" name="cartellini_gialli" min="0" max="2">

<label for="cartellini_rossi">Cartellini Rossi:</label>
<input type="number" name="cartellini_rossi" min="0" max="1">

        <label for="titolare">Titolare:</label>
        <input type="checkbox" name="titolare">

        <input type="submit" value="Aggiungi Statistiche">
        <div class="logout">
                <a href="home.php">torna indietro</a>
            </div>
    </form>
</body>
</html>
