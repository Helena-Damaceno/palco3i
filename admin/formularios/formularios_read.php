<?php

require_once(__DIR__ . '/../../conexao.php'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./formularios_read.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="bg-yellow-500 text-white text-xl font-bold p-4">
        <a href="painel_adm.php">Voltar</a>
    </div>

    <h1 class=" text-white text-xl font-bold p-4">Pesquisar Shows</h1>

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

    if (isset($_POST['titulo'])) {

        $titulo = $_POST['titulo'];
        $id_categ = $_POST['id_categ'];

        $sql = "SELECT * FROM shows WHERE titulo LIKE '%$titulo%'";

        if ($id_categ != "") {
            $sql = $sql . " AND id_categ = " . (int) $id_categ;
        }

        $resultado = mysqli_query($conexao, $sql);

        if (!$resultado) {
            echo "Erro: " . mysqli_error($conexao);
        } else {

            if (mysqli_num_rows($resultado) == 0) {
                echo "<p class='vazio'>Nenhum show encontrado.</p>";
            }

            echo "<div class='lista'>";

            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<div class='show'>";

                if ($linha['imagem'] != "") {
                    echo "<img src='../../uploads/" . $linha['imagem'] . "'>";
                }

                echo "<h3>" . $linha['titulo'] . "</h3>";
                echo "<p>ID: " . $linha['id_show'] . "</p>";
                echo "<p>" . $linha['descricao'] . "</p>";
                echo "<p>Data: " . $linha['data_show'] . "</p>";
                echo "<p>Local: " . $linha['locals'] . "</p>";
                echo "<p>Preço: R$ " . $linha['preco'] . "</p>";
                echo "<p>Ingressos: " . $linha['ing_disponiveis'] . "</p>";

                echo "</div>";
            }
            echo "</div>";
        }
    }

    ?>
</body>

</html>