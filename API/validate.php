<?php
header ('Content-Type: application/json');

require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\JWK;
use \Firebase\JWT\Key;

$token = $_POST['token'];

try {
    $decoded = JWT::decode($token, new key('ciao', 'HS256'));
    echo json_encode(array("error" => false, "msg" => "Verified Successfully", "data" => $decoded));
} catch (\Exception $e) {
    echo json_encode(array("error" => true, "msg" => $e->getMessage()));
}
?>