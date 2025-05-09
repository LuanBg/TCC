<?php
 
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_empresa = $_POST['codigo_empresa'];
    $cnpj = $_POST['cnpj'];

    // Conectar ao banco
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sistemaNotas", "root", "Bomfim1212$");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir nova empresa
        $stmt = $pdo->prepare("INSERT INTO empresas (codigo_empresa, cnpj) VALUES (?, ?)");
        $stmt->execute([$codigo_empresa, $cnpj]);

        header("Location: gerenciamento_empresas.php"); // Redireciona de volta para o gerenciamento
        exit;
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Empresa / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="text-center mb-5">
            <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 180px;">
        </div>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="text-center mb-4 text-success">Adicionar Nova Empresa</h2>
                <form method="POST" action="adicionar_empresa.php">
                    <div class="mb-3">
                        <label for="codigo_empresa" class="form-label">Código da Empresa</label>
                        <input type="text" class="form-control" id="codigo_empresa" name="codigo_empresa" required>
                    </div>
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">Adicionar Empresa</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="gerenciamento_empresas.php" class="btn btn-outline-success">
                <img src="images/icon_voltar.png" alt="Voltar" style="width: 40px;">
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
