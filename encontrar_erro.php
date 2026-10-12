<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$painel = __DIR__ . '/admin/formularios/painel_adm.php';
echo file_exists($painel) ? 'Painel encontrado<br>' : 'Painel NAO encontrado em: ' . $painel . '<br>';

include $painel;