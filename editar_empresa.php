<?php
include "conexao.php";


if (!isset($_GET['codigo_empresa'])) {
    echo "Código da empresa não fornecido.";
    exit;
}

$codigo_empresa = $_GET['codigo_empresa'];


$stmt = $pdo->prepare("SELECT * FROM empresas WHERE codigo_empresa = ?");
$stmt->execute([$codigo_empresa]);
$empresa = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$empresa) {
    echo "Empresa não encontrada.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novo_cnpj = $_POST['cnpj'];

    $update = $pdo->prepare("UPDATE empresas SET cnpj = ? WHERE codigo_empresa = ?");
    $update->execute([$novo_cnpj, $codigo_empresa]);

    
    header("Location: gerenciamento_empresas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }

        .card-verde {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .btn-verde {
            background-color: #B2DF76;
            border-color: #B2DF76;
            color: white;
        }

        .btn-verde:hover {
            background-color: #B2DF76;
            border-color: #B2DF76;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
        </div>

        <div class="card-verde text-center">
            <h2 class="mb-4">Editar Empresa</h2>

            <form method="POST">
                <div class="mb-3 text-start">
                    <label for="codigo" class="form-label">Código da Empresa</label>
                    <input type="text" class="form-control" id="codigo" name="codigo_empresa" value="<?php echo htmlspecialchars($empresa['codigo_empresa']); ?>" readonly>
                </div>

                <div class="mb-4 text-start">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo htmlspecialchars($empresa['cnpj']); ?>" required>
                </div>

                <button type="submit" class="btn btn-verde w-100">Salvar Alterações</button>
            </form>
        </div>
    </div>

</body>

</html>
