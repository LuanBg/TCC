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
            <input type="text" placeholder="Nome">
            <input type="text" placeholder="Sobrenome">
            <input type="email" placeholder="Email">
            <input type="text" placeholder="Cargo">
            <input type="text" placeholder="Endereço">
            <input type="text" placeholder="Nacionalidade">
            <input type="text" placeholder="Cidade">
            <input type="text" placeholder="CPF">
        </div>
        <div class="form-actions">
            <button type="submit">Cadastrar</button>
        </div>
        </form>
    </div>
</body>
</html>