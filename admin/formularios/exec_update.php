<?php
require_once(__DIR__ . '/../../conexao.php');


$cod = (int) $_POST['cod'];
$titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$data_show = mysqli_real_escape_string($conexao, $_POST['data_show']);
$locals = mysqli_real_escape_string($conexao, $_POST['locals']);
$preco = (float) $_POST['preco'];
$capacidade = (int) $_POST['capacidade'];
$ing_disponiveis = (int) $_POST['ing_disponiveis'];


$sql = "UPDATE shows SET
            titulo = '$titulo',
            descricao = '$descricao',
            data_show = '$data_show',
            locals = '$locals',
            preco = $preco,
            capacidade = $capacidade,
            ing_disponiveis = $ing_disponiveis
        WHERE id_show = $cod";

if (mysqli_query($conexao, $sql)) {
    $msg = "Registro atualizado com sucesso!";
} else {
    $msg = "Não foi possível atualizar: " . mysqli_error($conexao);
}


header("Location: formularios_update.php?retorno=" . urlencode($msg));
exit;
?>