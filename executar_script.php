<?php
// Fecha o Google Chrome
exec("taskkill /F /IM chrome.exe");

// Caminho para o script Python
$scriptPath = "C:\\xampp\\htdocs\\TCC\\script\\processar_empresas.py";

// Executa o script Python em segundo plano
pclose(popen("start /B \"\" python \"$scriptPath\"", "r"));

// Redireciona para a página desejada
header("Location: homeadm.php");
exit();
?>
