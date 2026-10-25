<?php

require_once(__DIR__ . '/../../conexao.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./formularios_update.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="painel_adm.php">Voltar</a>
    </div>

    <h1 class=" text-white text-xl font-bold p-4">Atualizar Registros</h1>

    <?php
    $sql = "SELECT * FROM shows";
    $res = mysqli_query($conexao, $sql);

    echo "<div class='lista'>";

    while ($linha = mysqli_fetch_assoc($res)) {
        $cod = $linha['id_show'];

        echo "<div class='show'>";

        if (!empty($linha['imagem'])) {
            echo "<img src='../../uploads/" . $linha['imagem'] . "'>";
        }

        echo "<h3>" . $linha['titulo'] . "</h3>";
        echo "<p>" . $linha['descricao'] . "</p>";
        echo "<p>Data: " . $linha['data_show'] . "</p>";
        echo "<p>Local: " . $linha['locals'] . "</p>";
        echo "<p>Preço: R$ " . $linha['preco'] . "</p>";
        echo "<p>Capacidade: " . $linha['capacidade'] . "</p>";
        echo "<p>Ingressos: " . $linha['ing_disponiveis'] . "</p>";
        echo "<a class='atualizar' href='formularios_update.php?cod=$cod'> Atualizar </a>";

        echo "</div>";
    }

    echo "</div>";
    ?>
    <?php

    if (isset($_GET['cod'])) {

        $cod = (int) $_GET['cod'];


        $sql = "SELECT * FROM shows WHERE id_show = $cod";
        $res = mysqli_query($conexao, $sql);
        $show = mysqli_fetch_assoc($res);

        if ($show) {
            ?>
            
            <h2 class=" text-white text-xl font-bold p-4">Altere os dados e clique em Atualizar</h2>

            <form action="exec_update.php" method="POST">
                <input type="hidden" name="cod" value="<?php echo $show['id_show']; ?>">

                Título:
                <input type="text" name="titulo" value="<?php echo $show['titulo'];  ?>">
                <br><br>

                Descrição:
                <input type="text" name="descricao" value="<?php echo $show['descricao']; ?>">
                <br><br>

                Data:
                <input type="date" name="data_show" value="<?php echo $show['data_show']; ?>">
                <br><br>

                Local:
                <input type="text" name="locals" value="<?php echo $show['locals']; ?>">
                <br><br>

                Preço:
                <input type="number" name="preco" step="0.01" value="<?php echo $show['preco']; ?>">
                <br><br>

                Capacidade:
                <input type="number" name="capacidade" value="<?php echo $show['capacidade']; ?>">
                <br><br>

                Ingressos disponíveis:
                <input type="number" name="ing_disponiveis" value="<?php echo $show['ing_disponiveis']; ?>">
                <br><br>

                <input type="submit" value="Atualizar">
            </form>
            <?php
        }
    }
    ?>

    <?php

    if (isset($_GET['retorno'])) {
        echo "<p style='color:red;'>" . $_GET['retorno'] . "</p>";
    }
    ?>

</body>

</html>