<?php 

include_once('conect.php'); 

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $inputUsername = $_POST['user'];
     $inputPassword = $_POST['password'];

     // Busca o usuário no banco de dados
     $stmt = $pdo->prepare("SELECT * FROM users WHERE user = :user");
     $stmt->bindParam(':user', $inputUsername);
     $stmt->execute();

     $user = $stmt->fetch(PDO::FETCH_ASSOC);

     if ($user && password_verify($inputPassword, $user['password'])) {
         // Login bem-sucedido, define a sessão
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['user'] = $user['user'];

         // Redireciona para a página de administração
         header("Location: src/admin/admin.php");
         exit;

     } else {
         // Credenciais inválidas
         echo "Usuário ou senha incorretos.";
     }

}

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- BOOTSATRAP CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <!-- ARQUIVO CSS -->
     <link rel="stylesheet" href="css/config.css" />

     <title>Login | Ames</title>
</head>
<body>
<div class="login-container">
        <h2>Login</h2>
        <form action="src/admin/admin.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="user" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>




<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>