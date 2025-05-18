<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .logo img {
            max-width: 200px;
            margin-bottom: 30px;
        }

        .card-verde {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 15px;
            background-color: #b9ec9b; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
    </style>
</head>

<body>

    <div class="container py-5">

        
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Logo" class="img-fluid logo">
        </div>

        
        <div class="card-verde text-center">
            <h2 class="mb-4">Configurações</h2>
            <button onclick="window.location.href='sobre.php'" class="btn btn-verde btn-lg">Sobre</button>
        </div>

        
        <div class="logout-button">
            <a href="home.php">
                <img src="images/icon_voltar.png" alt="Voltar">
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
