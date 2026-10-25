<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../area_adm.php");
    exit;
}
require_once('../../conexao.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./painel_adm.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
</head>

<body>
    <div id="container">

        <div id="topo">

            <div class="bg-yellow-500 text-white text-xl font-bold p-4">
                <a href="formularios_create.php">Cadastrar</a>
                <a href="formularios_update.php">Atualizar</a>
                <a href="formularios_delete.php">Excluir</a>
                <a href="formularios_read.php">Pesquisar</a>
                <a href="relatorio_shows.php">Relatório</a>

                <a href="../logout.php">Logout</a>
            </div>
        </div>
        <div id="conteudo">
            <div id="imagem">

                <h1 class="text-white text-xl font-bold p-4">Administração do Sistema</h1>
                <div class="caixa">
                    <?php
                    $sql = "SELECT * FROM shows";
                    $res = mysqli_query($conexao, $sql);

                    while ($linha = mysqli_fetch_assoc($res)) {
                        echo "<div class='show'>";
                        echo "Título: " . $linha['titulo'] . " - ";
                        echo "Descrição: " . $linha['descricao'] . " - ";
                        echo "Data: " . $linha['data_show'] . " - ";
                        echo "Preço: " . $linha['preco'] . " - ";
                        if (!empty($linha['imagem'])) {
                            echo "<img src='../../uploads/" . $linha['imagem'] . "' width='100'>";
                        }
                        echo "</div>";
                    }
                    ?>

                    <center>
                        <a href="formularios_create.php">
                            <img class="imagem" src="../../img/cad.jpg">
                        </a>
                    </center>
                </div>
            </div>
        </div>

    </div>
</body>

</html>