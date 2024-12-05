<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'ames';
$username = 'root';
$password = '';

try {

     

} catch(PDOException $e){

     die("Erro ao conectar ao banco de dados: " . $e->getMessage());

}

?>