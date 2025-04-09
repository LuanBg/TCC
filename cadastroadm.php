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
    <div class="user-info">
        <img src="images/use3-removebg-preview.png" alt="User">
        <h3>ADMINISTRADOR</h3>
    </div>

    <div class="content">
        <form action="homeadm.php" method="POST">
            <div class="tabs">
                <div class="tab" id="tab-usuario" onclick="location.href='cadastro.php'">Usuário</div>
                <div class="tab active" id="tab-admin">Administrador</div>
            </div>

            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="senha" placeholder="senha" required>
                <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <option selected>Selecione o cargo</option>
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>

            </div>
            <div class="form-actions">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>

</html>