<?php
require_once('conexao.php');

$titulo = "";
$id_categ = 0;

if (isset($_POST['titulo'])) {
  $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
  $id_categ = (int) $_POST['id_categ'];
}

$sql = "SELECT * FROM shows WHERE titulo LIKE '%$titulo%'";

if ($id_categ > 0) {
  $sql = $sql . " AND id_categ = $id_categ";
}

$sql = $sql . " ORDER BY data_show DESC";
$res = mysqli_query($conexao, $sql);
?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./painel.css?v=<?= time() ?>">
  <meta charset="UTF-8">
  <title>Painel Cliente</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div id="container">
    <div id="menu">

    </div>

    <div id="conteudo">
      <div id="imagem">

        <div id="cabecalho" class="bg-yellow-500 text-white text-xl font-bold p-4">

          <a href="admin/area_adm.php"> Cadastrar_Administrador</a>

          <a href="vendas.php">Vendas</a>

        </div>

        <div class="banner">

          <img src="imagens/SGTPEPPERSFESTIVAL.png" alt="Descrição da imagem">

</div>
         <div class="pesquisa"> 
        <form method="POST">
          Pesquisar:
          <input type="text" name="titulo">
          Categoria:
          <select name="id_categ">
            <option value="0">Todas</option>
            <option value="1">Rock</option>
            <option value="2">MPB</option>
            <option value="3">Pop</option>
            <option value="4">Samba</option>
          </select>
          <input class="procurar" type="submit" value="Procurar">
        </form>
</div>
      </div>

      <div class="shows">
        <?php
        while ($linha = mysqli_fetch_assoc($res)) {
          echo "<div class='card'>";
          echo "<h3 class='text-xl font-bold mb-2'>" . $linha['titulo'] . "</h3>";
          echo "<p>" . $linha['descricao'] . "</p>";
          echo "<p>Data: " . $linha['data_show'] . "</p>";
          echo "<p>Preço: R$ " . $linha['preco'] . "</p>";
           

          if (!empty($linha['imagem'])) {
            echo "<img src='uploads/" . $linha['imagem'] . "' height='200' width='400'>";
          }

          echo "<a class='vermais' href='detalhes.php?id=" . $linha['id_show'] . "'>   Ver Mais :</a>";

          echo "</div>";
        }
        ?>
      </div>

    </div>

  </div>
</body>

</html>