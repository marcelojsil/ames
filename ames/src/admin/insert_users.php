<?php
// Incluindo a conexão com o banco de dados
include_once('../../conect.php');

// Conectar ao banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Mensagens de sucesso e erro
$success_message = '';
$error_message = '';

// Processa o formulário de cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    $grupo_id = $_POST['grupo'];

    // Verifica se o grupo existe no banco
    $stmt_check_group = $conn->prepare("SELECT * FROM grupos_user WHERE id = ?");
    $stmt_check_group->bind_param("i", $grupo_id);
    $stmt_check_group->execute();
    $result_group = $stmt_check_group->get_result();

    if ($result_group->num_rows > 0) {
        // Cria o hash da senha
        $hashed_password = password_hash($pwd, PASSWORD_BCRYPT);

        // Prepara e executa a inserção do usuário no banco
        $stmt_insert_user = $conn->prepare("INSERT INTO users (username, senha, grupo) VALUES (?, ?, ?)");
        $stmt_insert_user->bind_param("ssi", $user, $hashed_password, $grupo_id);

        if ($stmt_insert_user->execute()) {
            $success_message = "Usuário inserido com sucesso!";
        } else {
            $error_message = "Erro ao inserir usuário: " . $stmt_insert_user->error;
        }

        // Fecha a consulta de inserção
        $stmt_insert_user->close();
    } else {
        $error_message = "Grupo não encontrado!";
    }

    // Fecha a consulta de verificação do grupo
    $stmt_check_group->close();
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>

    <!-- Exibe a mensagem de sucesso ou erro -->
    <?php if (!empty($success_message)) { echo "<p style='color: green;'>$success_message</p>"; } ?>
    <?php if (!empty($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

    <form method="POST" action="">
        <label for="user">Usuário:</label><br>
        <input type="text" id="user" name="user" required><br><br>

        <label for="pwd">Senha:</label><br>
        <input type="password" id="pwd" name="pwd" required><br><br>

        <label for="grupo">Grupo:</label><br>
        <select id="grupo" name="grupo" required>
            <?php
            // Buscar todos os grupos disponíveis na tabela grupos_user
            $conn = new mysqli($host, $username, $password, $dbname);
            $result = $conn->query("SELECT DISTINCT * FROM grupos_user");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['grupo'] . "</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
