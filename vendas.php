<?php
include('conexao.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comprar Ingressos</title>
</head>

<body>

<a href="painel.php">Voltar</a>

<h1>Comprar Ingressos</h1>

<?php

$sql = "SELECT * FROM shows";
$res = mysqli_query($conexao, $sql);


while ($linha = mysqli_fetch_assoc($res)) {
    $cod = $linha['id_show'];

    echo "Título: " . $linha['titulo'] . " - ";
    echo "Preço: R$ " . $linha['preco'] . " - ";
    echo "Ingressos: " . $linha['ing_disponiveis'] . " - ";
    echo "<a href='vendas.php?cod=$cod'>[ Comprar ]</a>";
    echo "<br><br>";
}


if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];

    $sql = "SELECT * FROM shows WHERE id_show = $cod";
    $res = mysqli_query($conexao, $sql);
    $show = mysqli_fetch_assoc($res);
?>
    <hr>
    <h2>Comprar Ingresso Do Show: <?php echo $show['titulo']; ?></h2>

    <form action="exec_vendas.php" method="POST">
        <input type="hidden" name="cod" value="<?php echo $show['id_show']; ?>">

        Nome: <input type="text" name="nome_comprador">
        <br><br>
        Email: <input type="text" name="email">
        <br><br>
        CPF: <input type="text" name="cpf">
        <br><br>
        Quantidade: <input type="number" name="qtd_ing">
        <br><br>

        <input type="submit" value="Confirmar compra">
    </form>
<?php
}

if (isset($_GET['retorno'])) {
    echo "<p style='color:red;'>" . $_GET['retorno'] . "</p>";
}
?>

</body>
</html>