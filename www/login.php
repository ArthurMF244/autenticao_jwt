<?php
require "config.php";
require "jwt.php";

header("Content-Type: application/json; charset=utf-8");

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE user_name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode([
        "status" => "ERROR",
        "msg" => "Usuário não encontrado."
    ]);
    exit;
}

$user = $res->fetch_assoc();

if (hash("sha256", $password) !== $user["password"]) {
    echo json_encode([
        "status" => "ERROR",
        "msg" => "Senha incorreta."
    ]);
    exit;
}

// Login OK
echo json_encode([
    "status" => "OK",
    "msg" => "Login realizado com sucesso!"
]);