<?php 

require('../conection.php') ;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
try {
    // Criar a conexão com PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Definir o modo de erro para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Dados a serem inseridos
    //$nome = "Marcelo";
    //$email = "marcelo@example.com";
    //$telefone = "987654321";

    // SQL para inserir os dados
    $sql = "INSERT INTO pessoas (nome, email) VALUES (:nome, :email)";

    // Preparar a consulta
    $stmt = $conn->prepare($sql);

    // Vincular os parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    
    // Executar a consulta
    $stmt->execute();

    echo "Novo registro inserido com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

}

?>