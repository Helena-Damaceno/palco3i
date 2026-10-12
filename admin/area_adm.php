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
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<h1>Login do Administrador</h1>

<form method="POST">
    Email: <input type="text" name="email">
    <br><br>
    Senha: <input type="password" name="senha">
    <br><br>
    <input type="submit" value="Entrar">
</form>

<p style="color:red;"><?php echo $mensagem; ?></p>

</body>
</html>