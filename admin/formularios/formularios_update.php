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
    <title>Atualizar os Shows</title>
</head>

<body>
    <a href="painel_adm.php"> Voltar </a>

    <h1> Atualizar Registros</h1>
    <?php
    require_once(__DIR__ . '/../../conexao.php');

    $sql = "select * from shows";
    $res = mysqli_query($conexao, $sql) or die(mysqli_connect_error());
    $num = mysqli_num_rows($res);

    while ($linha = mysqli_fetch_row($res)) {

        echo "Título: " . $linha[1] . ' - ';
        echo "Descrição: " . $linha[2] . ' - ';
        echo "Data: " . $linha[3] . ' - ';
        echo "Local: " . $linha[4] . ' - ';
        echo "Preço: " . $linha[5] . ' - ';
        echo "Capacidade: " . $linha[6] . ' - ';
        echo "Ingressos Disponíveis: " . $linha[7] . ' - ';

        echo "<a href='formularios_update.php?cod=$linha[0]'> [ Atualizar ] </a>";
        echo "<br />";
    }
    ?>
    <br /> <br /> <br /> <br /><br />

    <?php if ($show) { ?>

        <h1>Altere os dados e clique em Atualizar</h1>

        <form name="dados" action="exec_update.php" method="POST">
            <input type="hidden" name="cod" value="<?= $show['id_show'] ?>" />

            Título: <input type="text" name="titulo" size="50" maxlength="50"
                value="<?= htmlspecialchars($show['titulo']) ?>" required />
            <br /><br />

            Descrição: <input type="text" name="descricao" size="100" maxlength="200"
                value="<?= htmlspecialchars($show['descricao']) ?>" />
            <br /><br />

            Data: <input type="date" name="data_show" value="<?= $show['data_show'] ?>" required />
            <br /><br />

            Local: <input type="text" name="locals" size="100" maxlength="200"
                value="<?= htmlspecialchars($show['locals']) ?>" required />
            <br /><br />

            Preço: <input type="number" name="preco" step="0.01" min="0" value="<?= $show['preco'] ?>" required />
            <br /><br />

            Capacidade: <input type="number" name="capacidade" min="1" value="<?= $show['capacidade'] ?>" required />
            <br /><br />

            Ingressos Disponíveis: <input type="number" name="ing_disponiveis" min="0"
                value="<?= $show['ing_disponiveis'] ?>" required />
            <br /><br />

            <input type="submit" name="sub" value="Atualizar">
        </form>

    <?php } ?>

    <?php ?>

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