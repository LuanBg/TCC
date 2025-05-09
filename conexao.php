<?php
$host = 'localhost';
$port = '3306'; 
$db   = 'SistemaNotas';
$user = 'root';
$pass = 'Bomfim1212$'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass); // PADRONIZADO como $pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    $pdo = null;
}
?>
