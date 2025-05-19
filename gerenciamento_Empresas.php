<?php
include "conexao.php";

try {
    $stmt = $pdo->query("SELECT * FROM empresas");
    $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar empresas: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de Empresas | Bomfim Contabilidade</title>
  <link rel="stylesheet" href="css/style12.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
  <header class="top-header">
    <div class="logo-wrapper">
      <img src="images/logo20.png" alt="Logo Bomfim Contabilidade" class="logo" style="max-width: 280px;">
    </div>
    <nav class="top-nav">
      <a href="configuracoesadm.php" class="voltar-btn">← Voltar</a>
    </nav>
  </header>

  <div class="container">
    <div class="right-panel">
      <h2>Empresas Cadastradas</h2>

      <table class="tabela-empresas">
        <thead>
          <tr>
            <th>Código</th>
            <th>CNPJ</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($empresas as $empresa): ?>
            <tr>
              <td><?= htmlspecialchars($empresa['codigo_empresa']) ?></td>
              <td><?= htmlspecialchars($empresa['cnpj']) ?></td>
              <td>
                <a href="editar_empresa.php?codigo_empresa=<?= $empresa['codigo_empresa'] ?>" class="btn-acao editar">✏️</a>
                <a href="deletar_empresa.php?codigo_empresa=<?= $empresa['codigo_empresa'] ?>" class="btn-acao excluir" onclick="return confirm('Tem certeza que deseja excluir esta empresa?')">🗑️</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="acoes-geral">
        <a href="adicionar_empresa.php" class="btn-principal">+ Nova Empresa</a>
      </div>
    </div>
  </div>
</body>
</html>