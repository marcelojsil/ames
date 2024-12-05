<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: ../../login.html");
    exit;
}
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ADMIN | Ames</title>
</head>
<body>

     <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    <p>Esta é a página administrativa. Somente usuários logados podem acessá-la.</p>

    <form action="logout.php" method="POST">
        <button type="submit">Sair</button>
    </form>

</body>
</html>