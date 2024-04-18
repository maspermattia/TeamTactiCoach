<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Import JWT
require_once '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$token = $_GET['token']; 

try {
    $decoded = JWT::decode($token, new Key('ciao', 'HS256')); 
   
    $role = $decoded->profile->role;
    
    if ($role === 'admin') {
        $sql = "SELECT * FROM Giocatore";
    } else {
        $username = $decoded->profile->Username;
        $sql = "SELECT * FROM Giocatore WHERE SquadraID IN (
            SELECT SquadraID FROM Squadra WHERE Username = '$username'
        )";

    }
    
    $result = $conn->query($sql);

    $players = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $players[] = $row;
        }
    }
    
    echo json_encode(array( $players));
} catch (\Exception $e) {
    echo json_encode(array("error" => true, "msg" => $e->getMessage()));
}

$conn->close();
?>
