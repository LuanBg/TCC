<?php
include('conexao.php');

// Se o formulário foi enviado via POST, processa a atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id        = $_POST['id'];
    $nome      = trim($_POST['nome']);
    $email     = trim($_POST['email']);
    $tipo      = trim($_POST['tipo']);
    $novaSenha = trim($_POST['senha']);

    try {
        // Inicia a transação para atualizar ambas as tabelas
        $conn->beginTransaction();

        // Atualiza a tabela usuarios – se a senha for informada, atualiza também
        if ($novaSenha != '') {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $sqlUpdateUser = "UPDATE usuarios SET email = :email, senha = :senha, tipo_acesso = :tipo WHERE id = :id";
            $stmt = $conn->prepare($sqlUpdateUser);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
            $stmt->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sqlUpdateUser = "UPDATE usuarios SET email = :email, tipo_acesso = :tipo WHERE id = :id";
            $stmt = $conn->prepare($sqlUpdateUser);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Atualiza a tabela gerenciamento_usuarios
        $sqlUpdateGer = "UPDATE gerenciamento_usuarios SET nome_usuario = :nome, tipo = :tipo WHERE id = :id";
        $stmtGer = $conn->prepare($sqlUpdateGer);
        $stmtGer->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmtGer->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $stmtGer->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtGer->execute();

        $conn->commit();
        header("Location: gerenciamento.php");
        exit;
    } catch(PDOException $e) {
        $conn->rollBack();
        echo "Erro ao atualizar usuário: " . $e->getMessage();
        exit;
    }
}

// Se o método for GET, recupera os dados do usuário
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT u.id AS usuario_id, u.email, u.senha, u.tipo_acesso, g.nome_usuario 
            FROM usuarios u
            JOIN gerenciamento_usuarios g ON u.id = g.id
            WHERE u.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }
} else {
    echo "ID inválido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuário / Bomfim Contabilidade</title>
  <link rel="stylesheet" href="css/style5.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Editar Usuário</h2>
  <form action="editarusuario.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $usuario['usuario_id']; ?>">
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tipo de Acesso</label>
      <select name="tipo" class="form-control" required>
        <option value="admin" <?php if($usuario['tipo_acesso'] == 'admin') echo 'selected'; ?>>Administrador</option>
        <option value="user" <?php if($usuario['tipo_acesso'] == 'user') echo 'selected'; ?>>Usuário</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nova Senha (deixe em branco para manter a atual)</label>
      <input type="password" name="senha" class="form-control" placeholder="Digite a nova senha">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="gerenciamento.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
