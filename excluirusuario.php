<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $pdo->beginTransaction();
        
        
        $stmt1 = $pdo->prepare("DELETE FROM gerenciamento_usuarios WHERE id = :id");
        $stmt1->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();
        
        
        $stmt2 = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
        
        
        $pdo->commit();
        
        
        header("Location: gerenciamento.php");
        exit;
    } catch (PDOException $e) {
        
        $pdo->rollBack();
        echo "Erro ao excluir o usuário: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>
