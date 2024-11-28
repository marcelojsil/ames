<?php

include_once('./insert.php');

?>

<h1>Cadastro de Cliente</h1>
    <form action='insert.php' method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>