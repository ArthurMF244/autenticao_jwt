<?php
require "config.php";
require "jwt.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE user_name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    die("<h2 style='color:red; text-align:center;'>Usuário não encontrado ❌</h2>");
}

$user = $res->fetch_assoc();

if (hash("sha256", $password) !== $user["password"]) {
    die("<h2 style='color:red; text-align:center;'>Senha inválida ❌</h2>");
}

$payload = [
    "sub" => $user["id"],
    "name" => $user["full_name"],
    "email" => $user["email"],
    "role" => $user["role"],
    "iat" => time(),
    "exp" => time() + 3600
];

$token = gerar_jwt($payload, $JWT_SECRET);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

<div class="card-dashboard">

    <div class="user-icon">
        <i class="bi bi-person-circle"></i>
    </div>

    <h2>Bem-vindo, <?= $user["full_name"]; ?>!</h2>

    <label><b>Token JWT</b></label>

    <div class="token-wrapper">
        <textarea id="jwtToken" readonly><?= $token ?></textarea>

        <button class="copy-btn" onclick="copiarToken()">
            <i class="bi bi-clipboard"></i>
        </button>
    </div>

    <h3>Payload</h3>
    <div class="payload-box">
        <pre><?= json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>
    </div>

    <button class="btn-register" onclick="abrirModalCadastro()">
        <i class="bi bi-person-plus-fill"></i> Cadastrar Novo Usuário
    </button>

</div>

<!-- Fundo blur -->
<div id="overlay" class="overlay hidden" onclick="fecharModalCadastro()"></div>

<!-- Modal -->
<div id="modalCadastro" class="modal-cadastro hidden">

    <h3><i class="bi bi-person-fill-add"></i> Novo Usuário</h3>

    <label class="label-cadastro">Nome Completo</label>
    <input type="text" id="cad_nome">

    <label class="label-cadastro">Email</label>
    <input type="email" id="cad_email">

    <label class="label-cadastro">Usuário (login)</label>
    <input type="text" id="cad_user">

    <label class="label-cadastro">Senha</label>
    <input type="password" id="cad_senha">

    <div class="modal-actions">
        <button onclick="fecharModalCadastro()" class="btn-cancel">Cancelar</button>
        <button onclick="salvarNovoUsuario()" class="btn-confirm">Salvar</button>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/dashboard.js"></script>

</body>
</html>
