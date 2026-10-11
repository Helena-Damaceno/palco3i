<?php
$conexao = new mysqli("localhost", "root", "root", "palco");

if ($conexao->connect_error) {
    die("Erro" . $conexao->connect_error);
}
?>