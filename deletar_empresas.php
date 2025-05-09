<?php
if (isset($_GET['codigo_empresa'])) {
    $codigo_empresa = $_GET['codigo_empresa'];

    // Conectar ao banco
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=SistemaNotas", "root", "Bomfim1212$");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Excluir empresa
        $stmt = $pdo->prepare("DELETE FROM empresas WHERE codigo_empresa = ?");
        $stmt->execute([$codigo_empresa]);

        header("Location: gerenciamento_empresas.php"); // Redireciona para o gerenciamento
        exit;
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
