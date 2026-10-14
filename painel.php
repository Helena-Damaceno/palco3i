<?php
require_once('conexao.php');
?>
<!DOCTYPE html>
<html>

<head>
  <link href="painel.css" rel="stylesheet" type="text/css">
  <meta charset="UTF-8">
  <title>Painel Cliente</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-blue-500">
  <div id="container">
    <div id="menu">

    </div>

    <div id="conteudo">
      <div id="imagem">

        <div id="cabecalho" class="bg-yellow-500 text-white text-xl font-bold p-4">

          <a href="admin/area_adm.php"> Cadastrar_Administrador</a>

          <a href="vendas.php">Vendas</a>

        </div>

        <div class="bg-pink-50 font-bold p-4 text-2xl text-pink-50">

        </div>
        <h1>Shows Disponíveis</h1>
      </div>

      <div class="shows">
        <?php
        $sql = "SELECT * FROM shows ORDER BY data_show DESC";
        $res = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_assoc($res)) {
          echo "<div class='card'>";
          echo "<h3>" . $linha['titulo'] . "</h3>";
          echo "<p>" . $linha['descricao'] . "</p>";
          echo "<p>Data: " . $linha['data_show'] . "</p>";
          echo "<p>Preço: R$ " . $linha['preco'] . "</p>";

          if (!empty($linha['imagem'])) {
            echo "<img src='uploads/" . $linha['imagem'] . "' width='200'>";
          }
          echo "</div>";
        }
        ?>
      </div>

    </div>

  </div>
</body>

</html>