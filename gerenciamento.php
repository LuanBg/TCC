<?php
// Conexão ao banco
$host = 'localhost';
$port = '3306'; 
$db   = 'SistemaNotas';
$user = 'root';
$pass = 'Bomfim1212$'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento / Bomfim Contabilidade</title>
  <link rel="stylesheet" href="css/style5.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <div class="text-center mb-4">
      <img src="images/logo.png" alt="Bomfim Contabilidade" class="img-fluid" style="max-width: 200px;">
    </div>

    <div class="mb-4">
      <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar Usuário">
    </div>

    <h2>Gerenciamento de Usuários</h2>

    <?php
    if ($pdo) {
        try {
            $sql = "SELECT id AS usuario_id, usuario AS nome_usuario, email, tipo_acesso FROM usuarios";
            $stmt = $pdo->query($sql);
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($usuarios) > 0) {
                echo '<table class="table table-striped">';
                echo '<thead>
                        <tr>
                          <th>ID</th>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>Tipo de Acesso</th>
                          <th>Ações</th>
                        </tr>
                      </thead>';
                echo '<tbody id="tabelaUsuarios">';
                foreach ($usuarios as $usuario) {
                    echo '<tr data-nome="' . strtolower($usuario['nome_usuario']) . '">';
                    echo '<td>' . $usuario['usuario_id'] . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['nome_usuario']) . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['tipo_acesso']) . '</td>';
                    echo '<td>
                            <a href="editarusuario.php?id=' . $usuario['usuario_id'] . '" class="btn btn-primary btn-sm">Editar</a>
                            <a href="excluirusuario.php?id=' . $usuario['usuario_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\');">Excluir</a>
                          </td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Nenhum usuário encontrado.</p>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Erro: ' . $e->getMessage() . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Erro na conexão com o banco de dados.</div>';
    }
    ?>

    <div class="mt-3">
      <button onclick="location.reload();" class="btn btn-success">Atualizar Lista</button>
      <a href="homeadm.php" class="btn btn-secondary">Voltar</a>
    </div>
  </div>

  <script>
    document.getElementById('pesquisa').addEventListener('input', function () {
      const termo = this.value.toLowerCase();
      const linhas = document.querySelectorAll('#tabelaUsuarios tr');

      linhas.forEach(function (linha) {
        const nome = linha.getAttribute('data-nome');
        if (nome.includes(termo)) {
          linha.style.display = '';
        } else {
          linha.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
