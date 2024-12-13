<?php

session_start();
if ($_SESSION['grupo'] != 1) {
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Document</title>
</head>
<body>
    <h3>Bem vindo <?php echo $_SESSION['username'] ?> ao painel de administração.</h3>
    <br>
    <br>
    <br>
    <a href="../admin/insert_users.php">Adicionar Usuário</a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <a href="../logout.php">Sair</a>
</body>
</html>