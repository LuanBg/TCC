<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome      = trim($_POST["nome"]);
    $sobrenome = trim($_POST["sobrenome"]);
    $email     = trim($_POST["email"]);
    $senha     = trim($_POST["senha"]);
    $cargo     = trim($_POST["cargo"]);

    
    $nomeCompleto = $nome . " " . $sobrenome;

   
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        
        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmtCheck->bindValue(':email', $email, PDO::PARAM_STR);
        $stmtCheck->execute();

        if ($stmtCheck->fetchColumn() > 0) {
            echo "Este e-mail já está cadastrado. Por favor, use outro.";
            exit;
        }

       
        $conn->beginTransaction();

        
        $sqlUsuarios = "INSERT INTO usuarios (email, senha, tipo_acesso) VALUES (:email, :senha, :cargo)";
        $stmt1 = $conn->prepare($sqlUsuarios);
        $stmt1->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt1->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
        $stmt1->bindValue(':cargo', $cargo, PDO::PARAM_STR);
        $stmt1->execute();

        
        $sqlGerenciamento = "INSERT INTO gerenciamento_usuarios (nome_usuario, tipo) VALUES (:nome, :cargo)";
        $stmt2 = $conn->prepare($sqlGerenciamento);
        $stmt2->bindValue(':nome', $nomeCompleto, PDO::PARAM_STR);
        $stmt2->bindValue(':cargo', $cargo, PDO::PARAM_STR);
        $stmt2->execute();

       
        $conn->commit();

        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        
        $conn->rollBack();
        echo "Erro ao realizar o cadastro: " . $e->getMessage();
    }
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

</body>
</html>
