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

    <?php

    $sql = "SELECT * FROM shows";
    $res = mysqli_query($conexao, $sql);


    while ($linha = mysqli_fetch_assoc($res)) {
        $cod = $linha['id_show'];

        echo "Título: " . $linha['titulo'] . " - ";
        echo "Descrição: " . $linha['descricao'] . " - ";
        echo "Data: " . $linha['data_show'] . " - ";
        echo "Local: " . $linha['locals'] . " - ";
        echo "Preço: " . $linha['preco'] . " - ";


        echo "<a href='formularios_delete.php?cod=$cod'>[ Excluir ]</a>";


        if (!empty($linha['imagem'])) {
            echo "<br><img src='../../uploads/" . $linha['imagem'] . "' width='100'>";
        }

        echo "<br><br>";
    }
    ?>

    <?php

    if (isset($_GET['cod'])) {

        $cod = (int) $_GET['cod'];


        $sql = "SELECT * FROM shows WHERE id_show = $cod";
        $res = mysqli_query($conexao, $sql);
        $show = mysqli_fetch_assoc($res);


        if ($show) {
            ?>
            <hr>
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