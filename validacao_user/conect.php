<?php



// Configurações do banco de dados
$host = 'localhost';
$dbname = 'ames';
$username = 'root';
$password = '';

try {
     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
     echo "Erro na conexão: " . $e->getMessage();
 }

?>