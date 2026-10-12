<?php
session_start();
session_unset();
session_destroy();

header("Location: area_adm.php");
exit;
?>