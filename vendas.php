<?php
include('conexao.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./vendas.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>

    <div id="cabecalho" class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="painel.php">Voltar</a>
    </div>
    <h1 class=" text-white text-xl font-bold p-4">Comprar Ingressos</h1>
    <div class="lista">

        <?php
        $sql = "SELECT * FROM shows";
        $res = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_assoc($res)) {
            $cod = $linha['id_show'];

            echo "<div class='show'>";

            echo "Título: " . $linha['titulo'] . " - ";
            echo "Preço: R$ " . $linha['preco'] . " - ";
            echo "Ingressos: " . $linha['ing_disponiveis'] . " - ";
            echo "<a href='vendas.php?cod=$cod'>[ Comprar ]</a>";

            echo "</div>";
        }
        ?>

    </div>


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
    if (isset($_GET['retorno'])) {
        echo "<p style='color:red;'>" . $_GET['retorno'] . "</p>";
    }
    ?>

</body>

</html>