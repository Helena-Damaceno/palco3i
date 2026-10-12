<?php
require_once(__DIR__ . '/../../conexao.php');

$cod = (int) $_POST['cod'];


$sql = "SELECT imagem FROM shows WHERE id_show = $cod";
$res = mysqli_query($conexao, $sql);
$show = mysqli_fetch_assoc($res);


$sql = "DELETE FROM shows WHERE id_show = $cod";

if (mysqli_query($conexao, $sql)) {

   
    if ($show && $show['imagem'] != "" && file_exists('imagens/' . $show['imagem'])) {
        unlink('imagens/' . $show['imagem']);
    }

    $msg = "Registro excluído com sucesso!";
} else {
    $msg = "Não foi possível excluir.";
}


header("Location: formularios_delete.php?retorno=" . urlencode($msg));
exit;
?>