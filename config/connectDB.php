<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBPortifolio";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
