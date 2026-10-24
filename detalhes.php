<?php
include('conexao.php');

$id = (int) $_GET['id'];

$sql = "SELECT shows.*, categoria.nome_show
        FROM shows
        LEFT JOIN categoria ON shows.id_categ = categoria.id_categ
        WHERE shows.id_show = $id";
$res = mysqli_query($conexao, $sql);
$show = mysqli_fetch_assoc($res);

if (!$show) {
    echo "Show não encontrado";
    exit;
}
?>

<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
      <link rel="stylesheet" href="./detalhes.css?v=<?= time() ?>">
    <meta charset="UTF-8">
</head>

<body class="fundo">

    <div id="cabecalho" class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="painel.php">Voltar</a>
    </div>

    <h1><?php echo $show['titulo']; ?></h1>

    <?php
    if (!empty($show['imagem'])) {
        echo "<img src='uploads/" . $show['imagem'] . "' width='250' height='200'>";
    }
    ?>

    <p>Categoria: <?php echo $show['nome_show']; ?></p>
    <p>Descrição: <?php echo $show['descricao']; ?></p>
    <p>Data: <?php echo $show['data_show']; ?></p>
    <p>Local: <?php echo $show['locals']; ?></p>
    <p>Preço: R$ <?php echo $show['preco']; ?></p>
    <p>Capacidade: <?php echo $show['capacidade']; ?></p>
    <p>Ingressos disponíveis: <?php echo $show['ing_disponiveis']; ?></p>

    <hr>

    <?php
    if (isset($_GET['retorno'])) {
        echo "<p style='color:red;'>" . htmlspecialchars($_GET['retorno']) . "</p>";
    }

    if ($show['ing_disponiveis'] > 0) {
        ?>

        <h2 id="comprar">Comprar Ingresso</h2>

        <form action="exec_vendas.php" method="POST">
            <input type="hidden" name="cod" value="<?php echo $show['id_show']; ?>">

            Nome: <input type="text" name="nome_comprador" required>
            <br><br>
            Email: <input type="email" name="email" required>
            <br><br>
            CPF: <input type="text" name="cpf" maxlength="14" required>
            <br><br>
            Quantidade: <input type="number" name="qtd_ing" min="1" max="<?php echo $show['ing_disponiveis']; ?>" required>
            <br><br>

            <input type="submit" value="Confirmar compra">
        </form>

        <?php
    } else {
        echo "<h2>Ingressos esgotados</h2>";
    }
    ?>

</body>

</html>