<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectando ao banco de dados
    $conn = new mysqli("localhost", "root", "", "teste");

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Capturando o ID da pessoa a ser excluída
    $id = $_POST['delete_id'];

    // Excluindo o registro
    $sql = "DELETE FROM pessoas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Pessoa excluída com sucesso!";
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }

    // Fechando a conexão
    $conn->close();
}
?>