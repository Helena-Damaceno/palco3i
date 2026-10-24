<?php
include('conexao.php');

$cod = (int) $_POST['cod'];
$nome = mysqli_real_escape_string($conexao, $_POST['nome_comprador']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$qtd = (int) $_POST['qtd_ing'];

$sql = "SELECT * FROM shows WHERE id_show = $cod";
$res = mysqli_query($conexao, $sql);
$show = mysqli_fetch_assoc($res);

if ($qtd < 1) {
    $msg = "Quantidade inválida!";
} else if ($qtd > $show['ing_disponiveis']) {
    $msg = "Não tem ingressos suficientes!";
} else {

    $valor_total = $show['preco'] * $qtd;

    $sql = "INSERT INTO vendas (nome_comprador, email, cpf, qtd_ing, valor_total, data_compra, id_show)
            VALUES ('$nome', '$email', '$cpf', $qtd, $valor_total, NOW(), $cod)";
    mysqli_query($conexao, $sql);

    $sql = "UPDATE shows SET ing_disponiveis = ing_disponiveis - $qtd WHERE id_show = $cod";
    mysqli_query($conexao, $sql);

    $msg = "Compra realizada com sucesso!";
}

header("Location: detalhes.php?id=$cod&retorno=" . urlencode($msg));
exit;
?>