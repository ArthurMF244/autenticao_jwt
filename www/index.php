<?php
echo "<h1>Servidor PHP funcionando! 🚀</h1>";

$mysqli = new mysqli("mysql", "user", "password", "authdb");

if ($mysqli->connect_error) {
    echo "Erro ao conectar no MySQL: " . $mysqli->connect_error;
} else {
    echo "<p>MySQL conectado com sucesso!</p>";
}