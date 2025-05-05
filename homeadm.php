<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style4.css">
</head>

<body>

    <div class="form-group">
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>

        <form action="executar_script.php" method="post">
    <button type="submit" style="padding: 10px 180px;">Download de Notas</button>
</form>

        <button onclick="window.location.href='cadastroadm.php'">Cadastro</button>
        <button onclick="window.location.href='configuracoesadm.php'">Configurações</button>
    </div>

    <div class="logout-button">
        <a href="index.php"><img src="images/icon_desconect2.png" alt="Logout"></a>
    </div>

    <script src="js/script.js"></script>
</body>

</html>