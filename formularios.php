<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Administrador</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>



<head\>

<body>
    <a href="painel.php"> Principal </a>

    <h2> Cadastro para o acesso de Administrador</h2>

     <form method="POST">

        <label>Nome:</label>
        <input  name="nome_usuario" required>

        <br><br>

        <label>E-mail:</label>
        <input  name="email_usuario" required>

        <br><br>

        <label>Senha:</label>
        <input  name="senha" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>


