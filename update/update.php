<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectando ao banco de dados
    $conn = new mysqli("localhost", "root", "", "teste");

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Capturando os dados do formulário
    $id = $_POST['pessoa_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualizando os dados
    $sql = "UPDATE pessoas SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $email, $id);

    if ($stmt->execute()) {
        echo "Pessoa atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }

    // Fechando a conexão
    $conn->close();
}
?>

