<?php
require_once(__DIR__ . '/../../conexao.php');

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data_show = $_POST['data_show'];
$locals = $_POST['locals'];
$preco = $_POST['preco'];
$capacidade = $_POST['capacidade'];
$ing_disponiveis = $_POST['ing_disponiveis'];

$stmt = $conexao->prepare("UPDATE shows
    SET titulo = ?, descricao = ?, data_show = ?, locals = ?, preco = ?, capacidade = ?, ing_disponiveis = ?
    WHERE id_show = ?");
$stmt->bind_param("ssssdddi", $titulo, $descricao, $data_show, $locals, $preco, $capacidade, $ing_disponiveis, $_POST['cod']);
$stmt->execute();

$msg = urlencode('Registro atualizado com sucesso ! ! ! ');
header("location: formularios_update.php?retorno=$msg");
?>