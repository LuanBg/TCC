<?php
include('conexao.php');
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
    <!-- Área do logo da Bomfim -->
    <div class="text-center mb-4">
        <img src="images/logo.png" alt="Bomfim Contabilidade" class="img-fluid" style="max-width: 200px;">
    </div>

    <!-- Barra de pesquisa -->
    <div class="mb-4">
        <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar Usuário">
    </div>

    <h2>Gerenciamento de Usuários</h2>
    
    <?php
    try {
        // Realiza um JOIN entre as tabelas utilizando o mesmo id (recomendado para relacionamento)
        $sql = "SELECT u.id AS usuario_id, u.email, u.tipo_acesso, g.nome_usuario 
                FROM usuarios u
                JOIN gerenciamento_usuarios g ON u.id = g.id";
        $stmt = $conn->query($sql);
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
            echo '<tbody>';
            foreach ($usuarios as $usuario) {
                echo '<tr>';
                echo '<td>' . $usuario['usuario_id'] . '</td>';
                echo '<td>' . $usuario['nome_usuario'] . '</td>';
                echo '<td>' . $usuario['email'] . '</td>';
                echo '<td>' . $usuario['tipo_acesso'] . '</td>';
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
    } catch(PDOException $e) {
        echo '<div class="alert alert-danger">Erro: ' . $e->getMessage() . '</div>';
    }
    ?>
    
    <!-- Botões de controle -->
    <div class="mt-3">
      <button onclick="location.reload();" class="btn btn-success">Atualizar Lista</button>
      <a href="homeadm.php" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
  
  <script src="js/script.js"></script>
</body>
</html>
