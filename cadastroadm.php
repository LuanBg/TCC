<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $email   = trim($_POST["email"]);
    $senha   = trim($_POST["senha"]);
    $cargo   = trim($_POST["cargo"]);

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmtCheckEmail = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmtCheckEmail->bindValue(':email', $email, PDO::PARAM_STR);
        $stmtCheckEmail->execute();

        if ($stmtCheckEmail->fetchColumn() > 0) {
            echo "<script>alert('Este e-mail já está cadastrado!'); window.location.href='cadastroadm.php';</script>";
            exit;
        }

        $stmtCheckUser = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario");
        $stmtCheckUser->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmtCheckUser->execute();

        if ($stmtCheckUser->fetchColumn() > 0) {
            echo "<script>alert('Este nome de usuário já está em uso!'); window.location.href='cadastroadm.php';</script>";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, senha, tipo_acesso) VALUES (:usuario, :email, :senha, :tipo)");
        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $cargo, PDO::PARAM_STR);
        $stmt->execute();

        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='cadastroadm.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>
<?php
// (seu código PHP de validação permanece igual)
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro | Bomfim Contabilidade</title>
  <link rel="stylesheet" href="css/style3.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <img src="images/logo.png" alt="Logo Bomfim Contabilidade" class="logo">
      <a href="homeadm.php" class="voltar-btn">← Voltar</a>
    </div>

    <div class="right-panel">
      <h2>Criar Conta</h2>
      <form action="cadastroadm.php" method="POST" class="form-cadastro">
        <input type="text" name="usuario" placeholder="Nome de Usuário" required>
        <input type="email" name="email" placeholder="E-mail" required>

        <div class="input-group">
          <input type="password" name="senha" id="senha" placeholder="Senha" required>
          <button type="button" onclick="toggleSenha()">👁️</button>
        </div>

        <select name="cargo" required>
          <option value="" disabled selected>Tipo de Acesso</option>
          <option value="admin">Administrador</option>
          <option value="user">Usuário</option>
        </select>

        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>

  <script>
    function toggleSenha() {
      const senha = document.getElementById("senha");
      senha.type = senha.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
