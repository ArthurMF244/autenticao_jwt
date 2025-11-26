<?php
require "config.php";

$clientID = $_POST["clientID"] ?? "";
$clientSecret = $_POST["clientSecret"] ?? "";

if ($clientID !== $APP_CLIENT_ID || $clientSecret !== $APP_CLIENT_SECRET) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login do Usuário</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<div class="card">

    <h2><i class="bi bi-person-circle"></i> Login do Usuário</h2>

    <form method="POST" action="dashboard.php">

        <!-- Usuário -->
        <label>Usuário</label>
        <div class="div-cliente-id">
            <span class="input-icon"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="username" required>
        </div>

        <!-- Senha -->
        <label>Senha</label>
        <div class="div-cliente-secret">
            <span class="input-icon"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" required>
        </div>

        <!-- Botão -->
        <button type="submit" class="btn">
            <i class="bi bi-box-arrow-in-right"></i> Entrar
        </button>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/login_script.js"></script>

</body>
</html>