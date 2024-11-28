<?php
// Lista todas as imagens na pasta "imagens/"
$diretorio = 'imagens/';
$imagens = array_diff(scandir($diretorio), array('.', '..')); // Remove '.' e '..'

// Ordena as imagens, se necessário (não é necessário, mas é uma boa prática)
sort($imagens);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Login</title>
  <style>
    .login-container {
      text-align: center;
      margin-top: 50px;
    }
    img {
      width: 300px;
      height: auto;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2>Login</h2>
  <!-- Exibe a imagem do dia -->
  <img id="loginImage" src="" alt="Imagem do dia">
  <form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Usuário" required><br>
    <input type="password" name="password" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
  </form>
</div>

<script>
  // Função para revezar as imagens a cada dia
  function setImageOfTheDay() {
    const today = new Date();
    const dayOfMonth = today.getDate(); // Pega o dia do mês (1-31)
    
    // Lista as imagens recebidas do PHP
    const imagens = <?php echo json_encode($imagens); ?>;

    // Usa o dia do mês para escolher qual imagem mostrar
    const imageIndex = (dayOfMonth - 1) % imagens.length; // Para evitar ultrapassar o número de imagens
    const imagePath = 'imagens/' + imagens[imageIndex]; // Caminho completo da imagem

    // Define a imagem no src do elemento <img>
    document.getElementById('loginImage').src = imagePath;
  }

  // Chama a função ao carregar a página
  window.onload = setImageOfTheDay;
</script>

</body>
</html>
