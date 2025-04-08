<?php
$host = 'localhost';
$port = '3307'; // Porta do seu MySQL
$db   = 'SistemaNotas';
$user = 'root';
$pass = 'breno'; // ou a senha correta, se você definiu uma
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    $conn = null; // define como null para evitar erro no index.php
}
?>

