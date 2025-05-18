<?php
if (isset($_GET['codigo_empresa'])) {
    $codigo_empresa = $_GET['codigo_empresa'];

    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=SistemaNotas", "root", "Bomfim1212$");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $pdo->prepare("DELETE FROM empresas WHERE codigo_empresa = ?");
        $stmt->execute([$codigo_empresa]);

        header("Location: gerenciamento_empresas.php"); 
        exit;
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
