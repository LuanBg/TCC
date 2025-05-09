<?php
include "conexao.php";
// Buscar as empresas no banco
$stmt = $pdo->query("SELECT * FROM empresas");
$empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Empresas / Bomfim Contabilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style6.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <!-- Logo -->
        <div class="text-center mb-5">
            <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 180px;">
        </div>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="text-center mb-4 text-success">Gerenciamento de Empresas</h2>

                <!-- Tabela de Empresas -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Código da Empresa</th>
                            <th>CNPJ</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empresas as $empresa): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($empresa['codigo_empresa']); ?></td>
                                <td><?php echo htmlspecialchars($empresa['cnpj']); ?></td>
                                <td>
                                    <a href="editar_empresa.php?codigo_empresa=<?php echo $empresa['codigo_empresa']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="deletar_empresa.php?codigo_empresa=<?php echo $empresa['codigo_empresa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Adicionar Empresa -->
                <div class="text-center mt-4">
                    <a href="adicionar_empresa.php" class="btn btn-success btn-lg">Adicionar Nova Empresa</a>
                </div>
            </div>
        </div>

        <!-- Botão de Voltar -->
        <div class="text-center mt-5">
            <a href="configuracoesadm.php" class="btn btn-outline-success">
                <img src="images/icon_voltar.png" alt="Voltar" style="width: 40px;">
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
