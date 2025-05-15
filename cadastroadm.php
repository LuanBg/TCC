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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>

    <img src="images/logo.png" alt="Logo Bomfim Contabilidade" class="logo">

    <div class="content">
        <form action="cadastroadm.php" method="POST" class="form-cadastro">

            <div class="form-group">
                <input type="text" name="usuario" placeholder="Nome de Usuário" required>
                <input type="email" name="email" placeholder="E-mail" required>

                
                <div class="input-group">
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha()">👁️</button>
                </div>

                <select name="cargo" required>
                    <option value="" disabled selected>Selecione o tipo de acesso</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuário</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit">Cadastrar</button>
            </div>

            <div class="logout-button">
                <a href="homeadm.php"><img src="images/icon_voltar.png" alt="Voltar"></a>
            </div>
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
