<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
                <a href="index.php"><img src="images/sair-removebg-preview.png" alt="Logout"></a>
            </div>
        </form>
    </div>

</body>

</html>