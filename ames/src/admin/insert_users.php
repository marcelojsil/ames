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
    $id_comunidade = $_POST['comunidade'];

    // Verifica se o grupo existe no banco
    $stmt_check_group = $conn->prepare("SELECT * FROM grupos_user WHERE id = ?");
    $stmt_check_group->bind_param("i", $grupo_id);
    $stmt_check_group->execute();
    $result_group = $stmt_check_group->get_result();

    // Verifica se a comunidade existe no banco
    $stmt_check_comunidade = $conn->prepare("SELECT * FROM comunidades WHERE id = ?");
    $stmt_check_comunidade->bind_param("i", $id_comunidade);
    $stmt_check_comunidade->execute();
    $result_comunidade = $stmt_check_comunidade->get_result();

    if ($result_group->num_rows > 0) {
        // Cria o hash da senha
        $hashed_password = password_hash($pwd, PASSWORD_BCRYPT);

        // Prepara e executa a inserção do usuário no banco
        $stmt_insert_user = $conn->prepare("INSERT INTO users (username, senha, grupo, id_comunidade) VALUES (?, ?, ?, ?)");
        $stmt_insert_user->bind_param("ssii", $user, $hashed_password, $grupo_id, $id_comunidade);
        

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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Cadastro de Usuário</title>
</head>
<body>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Cadastro de Usuário de Sistema</h4>
                    </div>
                    <div class="card-body">

                        <!-- Exibe a mensagem de sucesso ou erro -->


                        <form method="POST" action="">
                            <label for="user" class="form-label">Usuário:</label><br>
                            <input class="form-control" type="text" id="user" name="user" required><br><br>

                            <label for="pwd" class="form-label">Senha:</label><br>
                            <input class="form-control" type="password" id="pwd" name="pwd" required><br><br>

                            <label for="grupo" class="form-label">Grupo:</label><br>
                            <select class="form-select" id="grupo" name="grupo" required>
                                <?php
                                // Buscar todos os grupos disponíveis na tabela grupos_user
                                $conn = new mysqli($host, $username, $password, $dbname);
                                $result = $conn->query("SELECT DISTINCT * FROM grupos_user");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['grupo'] . "</option>";
                                }
                                ?>
                            </select><br><br>
                            
                            <label for="comunidade" class="form-label">Comunidade:</label><br>
                            <select class="form-select" id="comunidade_id" name="comunidade" required>
                                <?php
                                // Buscar todos as comunidades disponíveis na tabela comunidades
                                $conn = new mysqli($host, $username, $password, $dbname);
                                $result = $conn->query("SELECT DISTINCT * FROM comunidades");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['comunidade'] . "</option>";
                                }
                                ?>
                            </select><br><br>

                            
                            
                            <input  class="btn btn-primary" type="submit" value="Cadastrar">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <?php if (!empty($success_message)) { echo "<div class='alert alert-success' role='alert'>$success_message</div>"; } ?>
       
    <?php if (!empty($error_message)) { echo "<div class='alert alert-danger' role='alert'>$error_message</div>"; } ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
