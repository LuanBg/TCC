<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            min-height: 100vh;
        }

        .logo img {
            max-width: 200px;
            margin-bottom: 30px;
        }

        .card-verde {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        .btn-verde {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-verde:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .logout-button {
            text-align: center;
            margin-top: 30px;
        }

        .logout-button img {
            max-width: 50px;
        }

        .btn-outline-primary {
            color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="card-verde text-center">
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
            <h2 class="mb-4">Configurações</h2>

            <div class="d-grid gap-2 mb-2">
            <button onclick="window.location.href='gerenciamento_empresas.php'" class="btn btn-outline-primary">Gerenciamento das Empresas</button>
            <button onclick="window.location.href='gerenciamento.php'" class="btn btn-outline-primary">Gerenciamento dos Usuarios</button>
            <button onclick="window.location.href='sobreadm.php'" class="btn btn-outline-primary">Sobre</button>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="homeadm.php" class="btn btn-outline-success">
                <img src="images/icon_voltar.png" alt="Voltar" style="width: 40px;">
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
