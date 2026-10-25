<?php

require_once(__DIR__ . '/../../conexao.php'); ?>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./formularios_delete.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="painel_adm.php">Voltar</a>
    </div>

    <h1>Excluir Registros</h1>

    <div class="lista">

        <?php
        $sql = "SELECT * FROM shows";
        $res = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_assoc($res)) {
            $cod = $linha['id_show'];

            echo "<div class='show'>";

            if (!empty($linha['imagem'])) {
                echo "<img src='../../uploads/" . $linha['imagem'] . "'>";
            }

            echo "<h3>" . $linha['titulo'] . "</h3>";
            echo "<p class='descricao'>" . $linha['descricao'] . "</p>";

            echo "<div class='info'>";
            echo "<p>Data: " . $linha['data_show'] . "</p>";
            echo "<p>Local: " . $linha['locals'] . "</p>";
            echo "</div>";

            echo "<p>Preço: R$ " . $linha['preco'] . "</p>";

            echo "<a class='atualizar' href='formularios_delete.php?cod=$cod'>Excluir</a>";

            echo "</div>";
        }
        ?>

    </div>

    <?php

    if (isset($_GET['cod'])) {

        $cod = (int) $_GET['cod'];


        $sql = "SELECT * FROM shows WHERE id_show = $cod";
        $res = mysqli_query($conexao, $sql);
        $show = mysqli_fetch_assoc($res);


        if ($show) {
            ?>

            <h2>Confirma exclusão do registro?</h2>

            <form action="exec_delete.php" method="POST">
                <input type="hidden" name="cod" value="<?php echo $show['id_show']; ?>">

                Título: <input type="text" readonly value="<?php echo $show['titulo']; ?>">
                <br><br>

                Descrição: <input type="text" readonly value="<?php echo $show['descricao']; ?>">
                <br><br>

                Local: <input type="text" readonly value="<?php echo $show['locals']; ?>">
                <br><br>

                Preço: <input type="text" readonly value="<?php echo $show['preco']; ?>">
                <br><br>

                Imagem: <input type="blob" readonly value="<?php echo $show['imagem']; ?>">
                <br><br>

                <input type="submit" value="Confirmar exclusão">
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