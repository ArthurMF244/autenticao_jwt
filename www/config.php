<?php

$mysqli = new mysqli("mysql", "user", "password", "authdb");

if ($mysqli->connect_error) {
    die("Erro ao conectar no MySQL: " . $mysqli->connect_error);
}

// clientID e clientSecret fictícios para o exercício
$APP_CLIENT_ID = "meuapp123";
$APP_CLIENT_SECRET = "segredo123";

// chave secreta para assinatura JWT
$JWT_SECRET = "minha_chave_muito_top_secreta";