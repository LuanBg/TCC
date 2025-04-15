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
        <form action="homeadm.php" method="POST">

            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <select class="form-select form-select-lg mb-3 select-cargo" name="cargo" required>
                    <option value="" disabled selected>Selecione o cargo</option>
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuário</option>
                </select>

            </div>

            <div class="form-actions">
                <button type="submit">Cadastrar</button>
            </div>

            <div class="logout-button">
                <a href="homeadm.php"><img src="images/icon_voltar.png" alt="Logout"></a>
            </div>
        </form>
    </div>

</body>

</html>