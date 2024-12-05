<?php
session_start(); // Inicia a sessão

// Destroi a sessão do usuário
session_destroy();

// Redireciona para a página de login
header("Location: index.php");
exit;
?>
