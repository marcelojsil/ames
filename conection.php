<?php

$host = "localhost"; // Endereço do servidor MySQL
$user = "root";      // Nome de usuário do MySQL
$password = "";      // Senha do MySQL
$dbname = "teste"; // Nome do banco de dados

try {
    // Criando a conexão
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Definindo o modo de erro para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}

// Fechar a conexão
//$conn = null;

?>
