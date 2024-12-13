<?php
// Incluindo o arquivo de configuração do banco de dados
include('../../conect.php');

// Consultar as idades das pessoas na tabela "pessoas"
$stmt = $pdo->query("SELECT TIMESTAMPDIFF(YEAR, dt_nascimento, CURDATE()) AS idade FROM pessoas");
$idades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar a contagem de idades por faixa etária
$faixa_etaria = [
    '0-18' => 0,
    '19-35' => 0,
    '36-50' => 0,
    '51+' => 0
];

// Contar quantas pessoas se encaixam em cada faixa etária
foreach ($idades as $idade) {
    if ($idade['idade'] <= 18) {
        $faixa_etaria['0-18']++;
    } elseif ($idade['idade'] <= 35) {
        $faixa_etaria['19-35']++;
    } elseif ($idade['idade'] <= 50) {
        $faixa_etaria['36-50']++;
    } else {
        $faixa_etaria['51+']++;
    }
}

// Preparar os dados para o gráfico
$labels = array_keys($faixa_etaria);
$data = array_values($faixa_etaria);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Pizza - Idades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Distribuição de Idades</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <canvas id="idadeChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Dados para o gráfico
        var ctx = document.getElementById('idadeChart').getContext('2d');
        var idadeChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>, // Faixas etárias
                datasets: [{
                    label: 'Distribuição de Idades',
                    data: <?php echo json_encode($data); ?>, // Contagem de pessoas por faixa etária
                    backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#57a3ff'], // Cores para cada faixa
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' pessoas';
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
