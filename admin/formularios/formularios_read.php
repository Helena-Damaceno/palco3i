<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<h1> Pesquisar Frases Famosas </h1>
<form name="pesquisar" action="form_pesquisar.php" method="POST" >
<h3>Informe: Nome do Autor(a)<input type="text" name="autor" size="150"/>
<input type="submit" value="Procurar" /> </b> </h3>
</form>

<?php
ini_set('display_errors', 0);
require_once('conectar.php');
$autor = $_POST['autor'];
//Teste necessário para evitar mostrar mensagem 
//de "Autor(a) não encontrado" na primeira vez que carrega a pagina
if (isset ($_POST['autor']))
{
//monta o comando SQL que busca os registros na tabela
$sql = "select * from cadastro where autor='$autor'"; 
$res = mysqli_query($conexao,$sql) or die(mysql_connect_error()); //executa o comando SQL
$num=mysqli_num_rows($res);
}

while ($linha = mysqli_fetch_assoc($res))
{
echo  "Código: ".$linha['codigo'];
echo "<br />";
echo "Frase: ".$linha['frase'];
echo "<br />";
echo "Autor(a): ".$linha['autor'];
echo "<br />"; echo "<br />"; echo "<br />";
 //variavel $foto recebe nome do arquivo da foto -- codigo do autor(a) frase + extensão jpg
  $foto = '../fotos/'.$linha['codigo'].'.jpg';
} 
if ($autor=="")
  {echo "Informe o nome para Pesquisar";}
else if ($num==0)
  {echo "Autor(a) não encontrado";}
?>
<img src="<?php echo $foto ?>">;
</body>
</html>
