<?php

    include_once('../conection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
        // Conexão com o banco de dados
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obter o valor do input
            $parteNome = $_POST['nome'];

            // Query para buscar os nomes
            $stmt = $pdo->prepare('SELECT nome, email FROM pessoas WHERE nome LIKE :nome');
            $stmt->bindValue(':nome', '%' . $parteNome . '%');
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultados) > 0) {
                echo "<h2>Resultados:</h2>";
                echo "<ul>";
                foreach ($resultados as $pessoa) {
                    echo "<li>" . htmlspecialchars($pessoa['nome']) . " - " . htmlspecialchars($pessoa['email']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhuma pessoa encontrada com o nome: " . htmlspecialchars($parteNome) . "</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erro ao conectar ao banco de dados: " . $e->getMessage() . "</p>";
        }
    }
    ?>