<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        // Inicia uma transação para garantir a exclusão em ambas as tabelas
        $conn->beginTransaction();
        
        // Exclui os dados da tabela gerenciamento_usuarios
        $stmt1 = $conn->prepare("DELETE FROM gerenciamento_usuarios WHERE id = :id");
        $stmt1->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();
        
        // Exclui os dados da tabela usuarios
        $stmt2 = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
        
        $conn->commit();
        // Após a exclusão, redireciona de volta para a página de gerenciamento
        header("Location: gerenciamento.php");
        exit;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Erro ao excluir o usuário: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>
