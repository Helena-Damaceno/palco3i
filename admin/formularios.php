<?php
require_once '../conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_usuario  = trim($_POST['nome_usuario']);
    $email_usuario = trim($_POST['email_usuario']);
    $senha         = trim($_POST['senha']);

    $sql = "INSERT INTO usuarios (nome_usuario, email_usuario, senha)
            VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome_usuario, $email_usuario, $senha);

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

    <title>Cadastro de Administrador</title>

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