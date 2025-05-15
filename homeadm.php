<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e6ffe6, #ffffff);
            min-height: 100vh;
        }

        .card-custom {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        .logo img {
            width: 180px;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-outline-primary {
            color: #28a745;
            border-color: #28a745;
        }

        .btn-outline-primary:hover {
            background-color: #28a745;
            color: white;
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-button img {
            width: 40px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logout-button img:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <div class="logout-button">
        <a href="index.php"><img src="images/icon_desconect2.png" alt="Logout"></a>
    </div>

    <div class="card card-custom text-center bg-white">
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>

        <form action="executar_script.php" method="post" class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Download de Notas</button>
        </form>

        <div class="d-grid gap-2 mb-2">
            <!-- Novo botão para outra automação -->
<!-- Botão para rodar nfe_downloader_constant.py -->
<form action="executar_nfe_downloader.php" method="post" class="d-grid gap-2 mb-3">
    <button type="submit" class="btn btn-primary btn-lg">Executar NFe Downloader</button>
</form>

            <button onclick="window.location.href='cadastroadm.php'" class="btn btn-outline-primary">Cadastro</button>
            <button onclick="window.location.href='configuracoesadm.php'" class="btn btn-outline-primary">Configurações</button>
            <button onclick="window.location.href='relatorio_execucaoadm.php'" class="btn btn-outline-primary">Relatório de Execução</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
