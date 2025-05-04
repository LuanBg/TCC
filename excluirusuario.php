<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $conn->beginTransaction();
        
        $stmt1 = $conn->prepare("DELETE FROM gerenciamento_usuarios WHERE id = :id");
        $stmt1->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();
        
        $stmt2 = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
        
        $conn->commit();
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
