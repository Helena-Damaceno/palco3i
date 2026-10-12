<!DOCTYPE html>
<html>
 <head>
 <link href="../css/estilo.css" rel="stylesheet" type="text/css">
 <meta charset="UTF-8">
 <title> Painel Administrativo </title>
 </head>
 <body>
<div id="container">
<div id="topo">    </div>
  <div id="menu">
    <a href="formularios.php">  Cadastrar  </a>    
    <a href="formularios_update.php">  Atualizar  </a>
    <a href="formularios_delete.php">    Excluir    </a>
    <a href="../php/form_pesquisar.php">  Pesquisar  </a>
  </div>
<div id="conteudo">
   <div id="imagem"> 
      <h1> Administração do Sistema Administração  </h1>
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
        echo "Imagem: " . $linha[4] . ' - ';
    }
       ?> 
       
<center> <a href="formularios.php"> <img class="imagem" src="../img/cad.jpg" /> 

</a> </center>
   </div>
</div> </div>    
</body></html>
