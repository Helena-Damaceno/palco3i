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

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($ext, $permitidas)) {
        $imagem = uniqid() . "." . $ext;
        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            __DIR__ . "/../../uploads/" . $imagem
        );
    }
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