<?php
require "config.php";
require "jwt.php"; // <-- IMPORTANTE!

function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

$token = $_POST["token"] ?? "";

if (!$token) {
    die(json_encode(["status" => "ERROR", "msg" => "Token não informado"]));
}

$parts = explode('.', $token);

if (count($parts) !== 3) {
    die(json_encode(["status" => "ERROR", "msg" => "Token inválido"]));
}

list($header_b64, $payload_b64, $signature_b64) = $parts;

// decodifica header e payload
$header = json_decode(base64url_decode($header_b64), true);
$payload = json_decode(base64url_decode($payload_b64), true);

// verifica expiração
if ($payload["exp"] < time()) {
    die(json_encode(["status" => "ERROR", "msg" => "Token expirado"]));
}

// recalcula assinatura
$valid_signature = base64url_encode(
    hash_hmac("sha256", "$header_b64.$payload_b64", $JWT_SECRET, true)
);

if ($valid_signature !== $signature_b64) {
    die(json_encode(["status" => "ERROR", "msg" => "Assinatura inválida"]));
}

echo json_encode([
    "status" => "OK",
    "usuario" => $payload
]);
