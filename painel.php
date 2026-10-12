<?php
require_once('conexao.php');
?>
<!DOCTYPE html>
<html>

<head>
  <link href="css/estilo.css" rel="stylesheet" type="text/css">
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
</head>

<body>
  <div id="container">

    <div id="topo"></div>

    <div id="menu">

    </div>

    <div id="conteudo">
      <div id="imagem">
        <div id="menu">
          <a href="admin/area_adm.php">Cadastrar Como Administrador</a>
           <a href="vendas.php">Vendas</a>
        </div>

      </div>

      <h1>Administração do Sistema</h1>

      <?php
      $sql = "SELECT * FROM shows ORDER BY data_show DESC";
      $res = mysqli_query($conexao, $sql);

      while ($linha = mysqli_fetch_assoc($res)) {
        echo "Título: " . $linha['titulo'] . " - ";
        echo "Descrição: " . $linha['descricao'] . " - ";
        echo "Data: " . $linha['data_show'] . " - ";
        echo "Preço: " . $linha['preco'] . " - ";
        if (!empty($linha['imagem'])) {
         echo "<img src='uploads/" . $linha['imagem'] . "' width='100'>";
        }
        echo "<br>";
      }
      ?>


    </div>
  </div>

  </div>
</body>

</html>