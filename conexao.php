<?php
$host = "localhost";
$user = "root";
$password = "cimatec"; // Se tiver senha, adicione aqui
$database = "SistemaNotas";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
