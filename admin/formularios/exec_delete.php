<?php
require_once(__DIR__ . '/../../conexao.php');


$cod = (int) $_POST['cod'];


$stmt = $conexao->prepare("SELECT imagem FROM shows WHERE id_show = ?");
$stmt->bind_param("i", $cod);
$stmt->execute();
$show = $stmt->get_result()->fetch_assoc();


$stmt = $conexao->prepare("DELETE FROM shows WHERE id_show = ?");
$stmt->bind_param("i", $cod);

if ($stmt->execute()) {
    // Apaga a foto da pasta "imagens" (se ela existir)
    if ($show['imagem'] && file_exists('imagens/' . $show['imagem'])) {
        unlink('imagens/' . $show['imagem']);
    }
    $msg = "Registro excluído com sucesso!";
} else {
    $msg = "Não foi possível excluir: " . $stmt->error;
}

header("Location: formularios_delete.php?retorno=" . urlencode($msg));
exit;