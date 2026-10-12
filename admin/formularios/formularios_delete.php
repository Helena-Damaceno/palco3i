<?php
require_once(__DIR__ . '/../../conexao.php');

$show = null;
if (isset($_GET['cod'])) {
    $cod = (int) $_GET['cod'];
    $stmt = $conexao->prepare("SELECT * FROM shows WHERE id_show = ?");
    $stmt->bind_param("i", $cod);
    $stmt->execute();
    $show = $stmt->get_result()->fetch_assoc();
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>

    <a href="painel_adm.php"> Voltar </a>

    <h1> Excluir Registros </h1>

    <?php
    require_once(__DIR__ . '/../../conexao.php');
    $sql = "select * from shows";
    $res = mysqli_query($conexao, $sql) or die(mysqli_connect_error());
    $num = mysqli_num_rows($res);
    while ($linha = mysqli_fetch_row($res)) {
        $cod = $linha[0];
        echo "Título: " . $linha[1] . ' - ';
        echo "Descrição: " . $linha[2] . ' - ';
        echo "Data: " . $linha[3] . ' - ';
        echo "Local: " . $linha[4] . ' - ';
        echo "Preço: " . $linha[5] . ' - ';
        echo "Capacidade: " . $linha[6] . ' - ';
        echo "Ingressos Disponíveis: " . $linha[7] . ' - ';
        echo "Imagem: " . $linha[8] . ' - ';

        echo "<a href='formularios_delete.php?cod=$cod'> [ Excluir ] </a> ";
        echo "<br />";
        echo "<br />";
    }
    ?>

    <?php if ($show) { ?>
        <h2>Confirma exclusão do registro?</h2>

        <form name="dados" action="exec_delete.php" method="POST">
            <input type="hidden" name="cod" value="<?= $show['id_show'] ?>" />

            Título: <input type="text" size="50" readonly value="<?= htmlspecialchars($show['titulo']) ?>" />
            <br /><br />

            Descrição: <input type="text" size="100" readonly value="<?= htmlspecialchars($show['descricao']) ?>" />
            <br /><br />

            Data: <input type="text" readonly value="<?= $show['data_show'] ?>" />
            <br /><br />

            Local: <input type="text" size="100" readonly value="<?= htmlspecialchars($show['locals']) ?>" />
            <br /><br />

            <input type="submit" name="excluir" value="Excluir" />
        </form>

    <?php } ?>


    <?php
    if (isset($_GET['retorno'])) {
        echo "<br />";
        echo "<font face='Arial' size='3' color='#F00'>";
        echo htmlspecialchars($_GET['retorno']);
        echo "</font>";
    }
    ?>
</body>

</html>