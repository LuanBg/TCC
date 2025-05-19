<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo_empresa = trim($_POST["codigo_empresa"]);
    $cnpj = trim($_POST["cnpj"]);

    try {
        // Verificar se o código da empresa já existe
        $stmtCheckCodigo = $pdo->prepare("SELECT COUNT(*) FROM empresas WHERE codigo_empresa = :codigo");
        $stmtCheckCodigo->bindValue(':codigo', $codigo_empresa, PDO::PARAM_STR);
        $stmtCheckCodigo->execute();

        if ($stmtCheckCodigo->fetchColumn() > 0) {
            echo "<script>alert('Este código de empresa já está cadastrado!'); window.location.href='adicionar_empresa.php';</script>";
            exit;
        }

        // Verificar se o CNPJ já existe
        $stmtCheckCnpj = $pdo->prepare("SELECT COUNT(*) FROM empresas WHERE cnpj = :cnpj");
        $stmtCheckCnpj->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmtCheckCnpj->execute();

        if ($stmtCheckCnpj->fetchColumn() > 0) {
            echo "<script>alert('Este CNPJ já está cadastrado!'); window.location.href='adicionar_empresa.php';</script>";
            exit;
        }

        // Inserir nova empresa
        $stmt = $pdo->prepare("INSERT INTO empresas (codigo_empresa, cnpj) VALUES (:codigo, :cnpj)");
        $stmt->bindValue(':codigo', $codigo_empresa, PDO::PARAM_STR);
        $stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->execute();

        echo "<script>alert('Empresa cadastrada com sucesso!'); window.location.href='gerenciamento_empresas.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Empresa | Bomfim Contabilidade</title>
  <link rel="stylesheet" href="css/style9.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
  <header class="top-header">
    <div class="logo-wrapper">
      <img src="images/logo20.png" alt="Logo Bomfim Contabilidade" class="logo" style="max-width: 280px;">
    </div>
    <nav class="top-nav">
      <a href="gerenciamento_empresas.php" class="voltar-btn">← Voltar</a>
    </nav>
  </header>

  <div class="container">
    <div class="right-panel">
      <h2>Adicionar Empresa</h2>
      <form action="adicionar_empresa.php" method="POST" class="form-cadastro">
        <input type="text" name="codigo_empresa" placeholder="Código da Empresa" required>
        <input type="text" name="cnpj" placeholder="CNPJ" required>
        <button type="submit" class="btn-principal">Cadastrar Empresa</button>
      </form>
    </div>
  </div>
</body>
</html>
