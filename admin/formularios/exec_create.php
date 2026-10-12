<?php
require_once(__DIR__ . '/../../conexao.php');


$titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$data_show = mysqli_real_escape_string($conexao, $_POST['data_show']);
$locals = mysqli_real_escape_string($conexao, $_POST['locals']);
$preco = (float) $_POST['preco'];
$capacidade = (int) $_POST['capacidade'];
$ing_disponiveis = (int) $_POST['ing_disponiveis'];
$id_categ = (int) $_POST['id_categ'];


$imagem = "";

if ($_FILES['imagem']['name'] != "") {
    
    $imagem = uniqid() . "_" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], 'imagens/' . $imagem);
}


$sql = "INSERT INTO shows
        (titulo, descricao, data_show, locals, preco, capacidade, ing_disponiveis, id_categ, imagem)
        VALUES
        ('$titulo', '$descricao', '$data_show', '$locals', $preco, $capacidade, $ing_disponiveis, $id_categ, '$imagem')";

if (mysqli_query($conexao, $sql)) {
    $msg = "Show cadastrado com sucesso!";
} else {
    $msg = "Deu erro ao cadastrar: " . mysqli_error($conexao);
}


header("Location: formularios_create.php?retorno=" . urlencode($msg));
exit;
?>