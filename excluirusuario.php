<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $pdo->beginTransaction();
        
        // Deletar o usuário da tabela 'gerenciamento_usuarios'
        $stmt1 = $pdo->prepare("DELETE FROM gerenciamento_usuarios WHERE id = :id");
        $stmt1->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();
        
        // Deletar o usuário da tabela 'usuarios'
        $stmt2 = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
        
        // Confirmar a transação
        $pdo->commit();
        
        // Redirecionar para a página de gerenciamento
        header("Location: gerenciamento.php");
        exit;
    } catch (PDOException $e) {
        // Desfazer a transação em caso de erro
        $pdo->rollBack();
        echo "Erro ao excluir o usuário: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>
