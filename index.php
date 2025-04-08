<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['email'];
    $senha = $_POST['senha'];

    if ($conn) {
        $dados = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $dados->execute([$usuario, $senha]);
        $user = $dados->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['tipo_acesso'] = $user['tipo_acesso'];

            if ($user['tipo_acesso'] === 'admin') {
                header("Location: homeadm.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }
        } else {
            echo "Usuário ou senha inválidos.";
        }
    } else {
        echo "Erro de conexão com o banco de dados.";
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
