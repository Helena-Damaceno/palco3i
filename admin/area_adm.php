<?php
session_start();
include('../conexao.php');

$mensagem = "";

if (isset($_POST['email'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email_usuario = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        $mensagem = "Erro no banco: " . mysqli_error($conexao);
    } else if ($email == "admin@gmail.com" && mysqli_num_rows($resultado) >= 1) {

        $_SESSION['admin'] = "sim";
        header("Location: formularios/painel_adm.php");
        exit;
    } else {
        $mensagem = "Email ou senha erradoss";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./area_adm.css?v=<?= time() ?>">
    <title>Login</title>
</head>

<body>
    <div id="cabecalho" class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="../painel.php">Voltar</a>
    </div>
    <div class="caixa">
        <h1 class=" text-xl font-bold p-4"> Login do Administrador</h1>

        <form method="POST" class="font-bold">
            Email:
            <br>
            <input type="text" name="email">
            <br><br>

            Senha:
            <br>
            <input type="password" name="senha">
            <br><br>
            <input type="submit" value="Entrar" class="entrar" class="text-white text-xl font-bold p-4">

        </form>


        <p style="color:red;"><?php echo $mensagem; ?></p>
    </div>
</body>

</html>