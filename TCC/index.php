<?php
session_start();
include "conexao.php"; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Se a senha estiver armazenada com password_hash(), use password_verify()
        if (password_verify($senha, $row['senha'])) { 
            $_SESSION['usuario'] = $row['email'];
            $_SESSION['tipo_acesso'] = $row['tipo_acesso'];

            // Redireciona para home.php após login bem-sucedido
            header("Location: home.php");
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <img src="images/logo.png" alt="Logo" class="logo">
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <div class="remember-forgot">
                    <label class="remember-label">
                        <input type="checkbox"> Lembrar-me
                    </label>
                    <div class="forgot-password">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                </div>
                <button type="submit">Entrar</button>
                <div class="register-link">
                    <span>Não tem conta?</span> <a href="cadastro.php">Cadastre-se</a>
                </div>
                <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
            </form>
        </div>
    </div>
</body>
</html>
