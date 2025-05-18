<?php

exec("taskkill /F /IM chrome.exe");


$scriptPath = "C:\\xampp\\htdocs\\TCC\\script\\processar_empresas.py";


pclose(popen("start /B \"\" python \"$scriptPath\"", "r"));


header("Location: homeadm.php");
exit();
?>
