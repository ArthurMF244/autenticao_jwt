<?php
require "config.php";

// Sempre retornar JSON
header("Content-Type: application/json; charset=utf-8");

// Verifica método
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "status" => "ERROR",
        "msg" => "Método inválido."
    ]);
    exit;
}

// Pega dados enviados
$clientID = $_POST["clientID"] ?? "";
$clientSecret = $_POST["clientSecret"] ?? "";

// Valida credenciais
if ($clientID === $APP_CLIENT_ID && $clientSecret === $APP_CLIENT_SECRET) {
    echo json_encode([
        "status" => "OK",
        "msg" => "Cliente autorizado. Pode prosseguir para login."
    ]);
} else {
    echo json_encode([
        "status" => "ERROR",
        "msg" => "clientID ou clientSecret inválidos."
    ]);
}
