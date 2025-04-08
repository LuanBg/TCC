<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro / Bomfim Contabilidade</title>
    <link rel="stylesheet" href="css/style3.css">
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
        <input type="text" name="cargo" placeholder="Cargo" required>
        </div>
        <div class="form-actions">
            <button type="submit">Cadastrar</button>
        </div>
        </form>
    </div>
</body>
</html>