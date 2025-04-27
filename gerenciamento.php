<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <input type="text" name="pesquisa" id="pesquisa" require>
            <h2>Usuário</h2>
            <input type="image" src="images/icon_perfil.png" alt="perfil">
            <button onclick="window.location.href='gerenciamento.php'">Excluir</button>
            <button onclick="window.location.href=''">Editar</button>
        </div>

        <script>
            function excluir() {
                if (confirm("Tem certeza que deseja excluir os dados?")) {
                    // Substitua 'delete.php' pelo caminho real do seu script de exclusão
                    window.location.href = 'gerenciamento.php';
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