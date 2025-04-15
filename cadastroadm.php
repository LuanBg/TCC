<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "cimatec", "SistemaNotas");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $nomeCompleto = $nome . ' ' . $sobrenome;

    // 🔍 Verificar se o e-mail já existe
    $stmtVerifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmtVerifica->bind_param("s", $email);
    $stmtVerifica->execute();
    $stmtVerifica->store_result();

    if ($stmtVerifica->num_rows > 0) {
        echo "<script>alert('Este e-mail já está cadastrado.'); window.history.back();</script>";
        $stmtVerifica->close();
        $conn->close();
        exit();
    }

    $stmtVerifica->close();

    // Inserir nas tabelas
    $stmtUsuarios = $conn->prepare("INSERT INTO usuarios (email, senha, tipo_acesso) VALUES (?, ?, ?)");
    $stmtUsuarios->bind_param("sss", $email, $senhaHash, $cargo);

    $stmtGerenciamento = $conn->prepare("INSERT INTO gerenciamento_usuarios (nome_usuario, tipo) VALUES (?, ?)");
    $stmtGerenciamento->bind_param("ss", $nomeCompleto, $cargo);

    if ($stmtUsuarios->execute() && $stmtGerenciamento->execute()) {
        header("Location: homeadm.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $stmtUsuarios->close();
    $stmtGerenciamento->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>

    <img src="images/logo.png" alt="Logo Bomfim Contabilidade" class="logo">

    <div class="content">
        <form action="cadastroadm.php" method="POST">

            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <select class="form-select form-select-lg mb-3 select-cargo" name="cargo" required>
                    <option value="" disabled selected>Selecione o cargo</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuário</option> <!-- Corrigido aqui -->
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

</body>
</html>
