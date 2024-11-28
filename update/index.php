<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pessoas</title>
</head>
<body>
    <h1>Gerenciar Pessoas</h1>
    
    <form action="update.php" method="post">
        <label for="pessoa">Escolha uma pessoa:</label>
        <select name="pessoa_id" id="pessoa">
            <?php
                // Conectando ao banco de dados
                $conn = new mysqli("localhost", "root", "", "teste");

                // Verificando a conexão
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Buscando os dados da tabela pessoas
                $sql = "SELECT id, nome, email FROM pessoas";
                $result = $conn->query($sql);

                // Exibindo as opções do select
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nome"] . " - " . $row["email"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma pessoa encontrada</option>";
                }

                // Fechando a conexão
                $conn->close();
            ?>
        </select>

        <br><br>

        <label for="nome">Novo Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="email">Novo Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <form action="delete.php" method="post" style="margin-top: 20px;">
        <label for="deletePessoa">Excluir Pessoa:</label>
        <select name="delete_id" id="deletePessoa">
            <?php
                // Repetindo o código de conexão para a exclusão
                $conn = new mysqli("localhost", "root", "", "teste");
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Buscando os dados da tabela
                $sql = "SELECT id, nome FROM pessoas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma pessoa encontrada</option>";
                }

                $conn->close();
            ?>
        </select>
        <br><br>
        <button type="submit">Excluir</button>
    </form>

</body>
</html>
