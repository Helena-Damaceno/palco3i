<?php
include('../../conexao.php');

require_once(__DIR__ . '/../../dompdf-3.1.6/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$sql = "SELECT * FROM shows";
$res = mysqli_query($conexao, $sql);

$html = "<meta charset='UTF-8'>";
$html = $html . "<h1>Relatório de Shows</h1>";
$html = $html . "<table border='1'>";
$html = $html . "<tr>";
$html = $html . "<th>ID Show</th>";
$html = $html . "<th>Título</th>";
$html = $html . "<th>Data</th>";
$html = $html . "<th>Local</th>";
$html = $html . "<th>Preço</th>";
$html = $html . "</tr>";

while ($linha = mysqli_fetch_assoc($res)) {
    $html = $html . "<tr>";
     $html = $html . "<td>".$linha['id_show'] . "</td>";
    $html = $html . "<td>" . $linha['titulo'] . "</td>";
    $html = $html . "<td>" . $linha['data_show'] . "</td>";
    $html = $html . "<td>" . $linha['locals'] . "</td>";
    $html = $html . "<td>R$ " . $linha['preco'] . "</td>";
    $html = $html . "</tr>";
}

$html = $html . "</table>";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("relatorio.pdf", ["Attachment" => false]);
?>