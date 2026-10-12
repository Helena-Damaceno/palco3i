<?php

require_once(__DIR__ . '/../../conexao.php');

$titulo          = $_POST['titulo'];
$descricao       = $_POST['descricao'];
$data_show       = $_POST['data_show'];
$locals          = $_POST['locals'];
$preco           = $_POST['preco'];
$capacidade      = $_POST['capacidade'];
$ing_disponiveis = $_POST['ing_disponiveis'];


$imagem = uniqid() . '_' . $_FILES['imagem']['name'];
move_uploaded_file($_FILES['imagem']['tmp_name'], 'imagens/' . $imagem);


$stmt = $conexao->prepare("INSERT INTO shows
    (titulo, descricao, data_show, locals, preco, capacidade, ing_disponiveis, imagem)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssdiis", $titulo, $descricao, $data_show, $locals, $preco, $capacidade, $ing_disponiveis, $imagem);

if ($stmt->execute()) {
    $msg = "Show cadastrado com sucesso!";
} else {
    $msg = "Deu erro ao cadastrar: " . $stmt->error;
}


header("Location: formularios_create.php?retorno=" . urlencode($msg));
exit;