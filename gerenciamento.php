<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style5.css">
</head>

<body>
    <div class="user-info">



    </div>

    <div class="content">

        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>

        <div class="form-group">
            <h2>Gerenciamento</h2>
            <button onclick="window.location.href='clear'">Excluir</button>
            <button onclick="window.location.href=''">Editar</button>
        </div>

        <script>
            function excluir() {
                if (confirm("Tem certeza que deseja excluir os dados?")) {
                    // Substitua 'delete.php' pelo caminho real do seu script de exclusão
                    window.location.href = 'delete.php';
                }
            }
        </script>


    </div>
    <div class="logout-button">
        <a href="homeadm.php"><img src="images/icon_voltar.png" alt="Logout"></a>
    </div>
    <script src="js/script.js"></script>
</body>

</html>