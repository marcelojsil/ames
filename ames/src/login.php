<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<?php
session_start();
include('../conect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar a consulta para verificar o usuário e a senha
    $stmt = $pdo->prepare("SELECT id, username, senha, grupo, id_comunidade FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['senha'])) {
        // A senha está correta, salvar os dados do usuário na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['grupo'] = $user['grupo'];
        $_SESSION['id_comunidade'] = $user['id_comunidade'];

        // Redirecionar para a página conforme o grupo
        switch ($user['grupo']) {
            case 1:
                header('Location: dash/admin.php');
                break;
            case 2:
                header('Location: dash/moderador.php');
                break;
            case 3:
                header('Location: dash/editor.php');
                break;
            case 4:
                header('Location: dash/view.php');
                break;
            default:
                echo "Grupo de usuário não reconhecido.";             
                exit;
        }
    } else {
        // Se o usuário ou senha não estiverem corretos
        echo "Usuário ou senha inválidos.";
    }
}
?>