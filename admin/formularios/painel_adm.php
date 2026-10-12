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
    <link href="../../css/estilo.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
</head>

<body>
    <div id="container">

        <div id="topo"></div>

        <div id="menu">
            <a href="formularios_create.php">Cadastrar</a>
            <a href="formularios_update.php">Atualizar</a>
            <a href="formularios_delete.php">Excluir</a>
            <a href="formularios_read.php">Pesquisar</a>
            <a href="../logout.php">Sair</a>
        </div>

        <div id="conteudo">
            <div id="imagem">

                <h1>Administração do Sistema</h1>

                <?php
                $sql = "SELECT * FROM shows";
                $res = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_assoc($res)) {
                    echo "Título: " . $linha['titulo'] . " - ";
                    echo "Descrição: " . $linha['descricao'] . " - ";
                    echo "Data: " . $linha['data_show'] . " - ";
                    echo "Preço: " . $linha['preco'] . " - ";
                    if (!empty($linha['imagem'])) {
                        echo "<img src='../../uploads/" . $linha['imagem'] . "' width='100'>";
                    }
                    echo "<br>";
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
</body>

</html>