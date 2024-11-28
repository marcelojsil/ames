

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pessoas</title>
</head>
<body>
    <h1>Buscar Pessoas</h1>
    <form method="POST" action="">
        <label for="nome">Parte do Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <button type="submit">Buscar</button>
    </form>

<?php

    include_once('./search.php');

?>
    
</body>
</html>