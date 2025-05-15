<?php
// Fecha o Google Chrome e o chromedriver
exec("taskkill /F /IM chrome.exe >nul 2>&1");
exec("taskkill /F /IM chromedriver.exe >nul 2>&1");

// Caminho completo do script
$scriptPath = "C:\\xampp\\htdocs\\TCC\\script\\autonfe.py";

// Executa o script Python com interface (sem /B)
exec("start \"\" python \"$scriptPath\"");

// Redireciona de volta para a página inicial
header("Location: homeadm.php");
exit();
?>
