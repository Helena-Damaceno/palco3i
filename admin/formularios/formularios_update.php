<?php

require_once(__DIR__ . '/../../conexao.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Atualizar os Shows</title>
</head>

<body>

<a href="painel_adm.php">Voltar</a>

<h1>Atualizar Registros</h1>

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
    echo "Capacidade: " . $linha['capacidade'] . " - ";
    echo "Ingressos: " . $linha['ing_disponiveis'] . " - ";

   
    echo "<a href='formularios_update.php?cod=$cod'>[ Atualizar ]</a>";

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
        <h2>Altere os dados e clique em Atualizar</h2>

        <form action="exec_update.php" method="POST">
            <input type="hidden" name="cod" value="<?php echo $show['id_show']; ?>">

            Título:
            <input type="text" name="titulo" value="<?php echo $show['titulo']; ?>">
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