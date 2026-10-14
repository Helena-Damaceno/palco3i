<?php

require_once(__DIR__ . '/../../conexao.php'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pesquisar Shows</title>
</head>

<body>

    <a href="painel_adm.php">Voltar</a>

    <h1>Pesquisar Shows</h1>

    <form method="POST">
        Título do show:
        <input type="text" name="titulo">
        Categoria:
        <select name="id_categ">
            <option value="">Todas</option>
            <option value="1">Rock</option>
            <option value="2">MPB</option>
            <option value="3">Pop</option>
            <option value="4">Samba</option>
        </select>
        <input type="submit" value="Procurar">
    </form>

    <br>

    <?php

    if (isset($_POST['id_categ'])) {

        $id_categ = (int) $_POST['id_categ'];

        $sql = "SELECT * FROM shows WHERE id_categ = $id_categ";
        $resultado = mysqli_query($conexao, $sql);


        if (!$resultado) {
            echo "Erro: " . mysqli_error($conexao);
        } else {


            if (mysqli_num_rows($resultado) == 0) {
                echo "Nenhum show encontrado.";
            }

            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "Título: " . $linha['titulo'] . "<br>";
                echo "Descrição: " . $linha['descricao'] . "<br>";
                echo "Data: " . $linha['data_show'] . "<br>";
                echo "Local: " . $linha['locals'] . "<br>";
                echo "Preço: R$ " . $linha['preco'] . "<br>";
                echo "Ingressos disponíveis: " . $linha['ing_disponiveis'] . "<br>";

                if ($linha['imagem'] != "") {
                    echo "<img src='../../uploads/" . $linha['imagem'] . "' width='250'>";
                }

                echo "<hr>";
            }
        }
    }
    ?>

</body>

</html>