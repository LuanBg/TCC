<?php
session_start();
include 'conexao.php'; 

$erro = "";


$usuario_padrao = 'admin2';
$email_padrao = 'admin@teste.com';
$senha_padrao = password_hash('123456', PASSWORD_DEFAULT);
$tipo_padrao = 'admin';


$verifica = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
$verifica->execute([$usuario_padrao]);
if ($verifica->fetchColumn() == 0) {
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, email, tipo_acesso) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario_padrao, $senha_padrao, $email_padrao, $tipo_padrao]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_input = $_POST['usuario'] ?? '';
    $senha_input = $_POST['senha'] ?? '';

    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario_input]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha_input, $user['senha'])) {
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
            $erro = "Usuário ou senha inválidos.";
        }
    } else {
        $erro = "Erro de conexão com o banco de dados.";
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
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button>
                <?php if (!empty($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
            </form>
        </div>
    </div>
</body>
</html>
