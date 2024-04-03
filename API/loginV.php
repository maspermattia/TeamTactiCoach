<?php

header ('Content-Type: application/json');
// import jwt
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

try {
    $query = "SELECT * FROM AllenatoreTesserato  WHERE username = ? AND Password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $secret = "ciao";
        $data = array(
            'profile' => 
                    [
                        "nome" => $row["Nome"],
                        "cognome" => $row["Cognome"],
                        "email" => $row["email"],
                    ],
            "role" => $row["ruolo"],
        );
        $token = JWT::encode($data, $secret, 'HS256');
        header("Location: API.php");
        
    } else {
        echo json_encode(array("error" => true, "msg" => "Invalid email or password"));
    }
} catch (Exception $e) {
    
    echo json_encode(array("error" => true, "msg" => "Login failed"));
}

?>