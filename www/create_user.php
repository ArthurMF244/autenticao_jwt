<?php
require "config.php";

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$user = $_POST["user"] ?? "";
$senha = $_POST["senha"] ?? "";

if (!$nome || !$email || !$user || !$senha) {
    echo json_encode(["status" => "ERROR", "msg" => "Preencha todos os campos."]);
    exit;
}

$senha_hash = hash("sha256", $senha);

// verifica duplicado
$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE user_name = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo json_encode(["status" => "ERROR", "msg" => "Usuário já existe."]);
    exit;
}

// insere
$stmt = $mysqli->prepare("
    INSERT INTO usuarios (full_name, email, user_name, password, role) 
    VALUES (?, ?, ?, ?, 'user')
");
$stmt->bind_param("ssss", $nome, $email, $user, $senha_hash);

if ($stmt->execute()) {
    echo json_encode(["status" => "OK", "msg" => "Usuário cadastrado com sucesso!"]);
} else {
    echo json_encode(["status" => "ERROR", "msg" => "Erro ao cadastrar usuário."]);
}