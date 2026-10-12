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
        header("Location: painel_adm.php");
        exit;
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

</head>

<body>
    <a href="../painel.php"> Principal </a>
    <h2> Cadastro para o acesso de Administrador</h2>

    <?php if ($mensagem): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Nome:</label>
        <input name="nome_usuario" required>

        <br><br>

        <label>E-mail:</label>
        <input type="email" name="email_usuario" required>

        <br><br>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>
</body>
</html>