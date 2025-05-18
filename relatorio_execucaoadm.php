<?php
$mysqli = new mysqli("localhost", "root", "Bomfim1212$", "SistemaNotas");

$query = "
SELECT 
    COUNT(*) AS total,
    SUM(status = 'sucesso') AS sucesso,
    SUM(status = 'erro') AS erro,
    AVG(duracao_segundos) AS duracao_media
FROM logs_execucao
";

$result = $mysqli->query($query);
$stats = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Execução</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Dashboard - Execução de Empresas</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Total Processadas</h5>
                        <h3><?= $stats['total'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Com Sucesso</h5>
                        <h3><?= $stats['sucesso'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5>Com Erro</h5>
                        <h3><?= $stats['erro'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-dark bg-warning">
                    <div class="card-body">
                        <h5>Tempo Médio (s)</h5>
                        <h3><?= number_format($stats['duracao_media'], 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <a href="homeadm.php" class="btn btn-secondary mt-4">Voltar</a>
    </div>
</body>
</html>
