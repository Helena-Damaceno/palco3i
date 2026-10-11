<?php
require_once '../conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $data_show = trim($_POST['data_show']);
    $locals = trim($_POST['locals']);
    $preco = trim($_POST['preco']);
    $capacidade = trim($_POST['capacidade']);
    $ing_disponiveis = trim($_POST['ing_disponiveis']);
    $imagem = trim($_POST['imagem']);
    $id_categ = trim($_POST['id_categ']);

    $sql = "INSERT INTO shows (titulo, descricao, data_show, locals, preco, capacidade, ing_disponiveis, imagem, id_categ)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssddddi", $titulo, $descricao, $data_show, $locals, $preco, $capacidade, $ing_disponiveis, $imagem, $id_categ);

    if ($stmt->execute()) {
        $mensagem = "Show cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Shows</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>



<head\>

<body>
    <a href="layout.php"> Principal </a>
    <a href="painel.php"> Principal </a>
    <h2> Cadastro para o acesso de Shows
    </h2>

     <form method="POST">

        <label>Nome:</label>
        <input  type="text" name="titulo" required>

        <br><br>

        <label>Descrição:</label>
        <input  type="text" name="descricao" required>

        <br><br>

        <label>Data do Show:</label>
        <input  type="date" name="data_show" required>

        <br><br>

        <label>Local:</label>
        <input  type="text" name="locals" required>

        <br><br>

        <label>Preço:</label>
        <input  type="number" name="preco" step="0.01" required>

        <br><br>

        <label>Capacidade:</label>
        <input  type="number" name="capacidade" required>

        <br><br>

        <label>Ingressos Disponíveis:</label>
        <input  type="number" name="ing_disponiveis" required>

        <br><br>

        <label>Imagem:</label>
        <input  type="url" name="imagem" required>

        <br><br>

        <label> Categoria:</label>
        <input  type="number" name="id_categ" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>


