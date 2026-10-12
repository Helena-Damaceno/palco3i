<html>

<head>
  <meta charset="UTF-8">
  <title> Cadastrando Shows </title>
</head>

<body>

  <a href="painel_adm.php"> Voltar </a>

  <h1> Formulário para Cadastrar Shows</h1>

  <form name="dados" action="exec_create.php" method="POST" enctype="multipart/form-data">

    Nome do Show: <input type="text" name="titulo" size="150" /> <br /> <br />

    Descrição: <input type="text" name="descricao" size="150" /> <br /> <br />

    Data: <input type="date" name="data_show" /> <br /> <br />

    Local: <input type="text" name="locals" size="150" /> <br /> <br />

    Preço: <input type="float" name="preco" size="150" /> <br /> <br />

    Capacidade: <input type="text" name="capacidade" size="150" /> <br /> <br />

    Ingressos Disponiveis: <input type="int" name="ing_disponiveis" size="150" /> <br /> <br />

    Categoria:
    <select name="id_categ" required>
      <option value="">Selecione uma categoria</option>
      <option value="1">Rock</option>
      <option value="2">MPB</option>
      <option value="3">Pop</option>
      <option value="4">Samba</option>
    </select>

    <input type="file" name="imagem" /> <br> <br>

    <input type="submit" name="btn" value="Cadastrar" />

  </form>

  <?php
  if (isset($_GET['retorno']))

    $msg = $_GET['retorno'];
  echo "<br />";
  echo "<font size='5' color='#F00'>";
  echo $msg;
  $msg = "";
  echo "</font>";

  ?>
</body>

</html>