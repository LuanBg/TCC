<?php 

$host = 'localhost';
$port = '3306'; 
$db   = 'SistemaNotas';
$user = 'root';
$pass = 'Bomfim1212$'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    $pdo = null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id        = $_POST['id'];
    $nome      = trim($_POST['nome']);
    $email     = trim($_POST['email']);
    $tipo      = trim($_POST['tipo']);
    $novaSenha = trim($_POST['senha']);

    try {
        $pdo->beginTransaction();

        if ($novaSenha != '') {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE usuarios SET usuario = :nome, email = :email, senha = :senha, tipo_acesso = :tipo WHERE id = :id";
            $stmt = $pdo->prepare($sqlUpdate);
            $stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
        } else {
            $sqlUpdate = "UPDATE usuarios SET usuario = :nome, email = :email, tipo_acesso = :tipo WHERE id = :id";
            $stmt = $pdo->prepare($sqlUpdate);
        }

        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $pdo->commit();
        header("Location: gerenciamento.php");
        exit;
    } catch(PDOException $e) {
        $pdo->rollBack();
        echo "Erro ao atualizar usuário: " . $e->getMessage();
        exit;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, usuario, email, tipo_acesso FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
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
    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
    
    <div class="mb-3">
      <label class="form-label">Nome Completo</label>
      <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required>
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
      <div class="input-group">
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a nova senha">
        <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha()">👁️</button>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="gerenciamento.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<script>
  function toggleSenha() {
    const senhaInput = document.getElementById('senha');
    const tipo = senhaInput.getAttribute('type');
    senhaInput.setAttribute('type', tipo === 'password' ? 'text' : 'password');
  }
</script>

</body>
</html>
