<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/includes/functions.php';

// 1. DADOS DO CALENDÁRIO
$mes = date('m');
$ano = date('Y');
$diasNoMes = date('t');
$primeiroDiaSemana = date('w', strtotime("$ano-$mes-01"));
$todasConsultas = listarConsultas($conexao);

$agenda = [];
foreach ($todasConsultas as $c) {
    if (date('m', strtotime($c['dia'])) == $mes && date('Y', strtotime($c['dia'])) == $ano) {
        $dia = (int)date('d', strtotime($c['dia']));
        $agenda[$dia][] = $c;
    }
}

// 2. DADOS DO GRÁFICO FINANCEIRO (Busca das tabelas entrada e saida)
$financas = obterResumoFinanceiro($conexao);
$totalEntradas = $financas['entradas'];
$totalSaidas   = $financas['saidas'];
$saldo         = $totalEntradas - $totalSaidas;

// Cálculo das porcentagens das barras para o CSS
$maxValor = max($totalEntradas, $totalSaidas, 1);
$pctEntradas = min(100, round(($totalEntradas / $maxValor) * 100));
$pctSaidas   = min(100, round(($totalSaidas / $maxValor) * 100));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Geral</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .dashboard-container { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        
        /* CARD DO GRÁFICO FINANCEIRO */
        .card-grafico {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            min-width: 300px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .barra-grupo { margin-bottom: 15px; }
        .barra-label { font-size: 14px; font-weight: bold; margin-bottom: 5px; display: flex; justify-content: space-between; }
        .barra-fundo { background: #e0e0e0; height: 25px; border-radius: 12px; overflow: hidden; }
        .barra-preenchimento { height: 100%; border-radius: 12px; transition: width 0.5s ease; }
        
        .cor-entrada { background-color: #2e7d32; } /* Verde */
        .cor-saida { background-color: #c62828; }   /* Vermelho */
        
        .resumo-cards { display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; }
        .resumo-box { text-align: center; }
        .resumo-box small { color: #666; font-size: 12px; }
        .resumo-box strong { display: block; font-size: 16px; margin-top: 3px; }

        /* CARD DO CALENDÁRIO */
        .card-calendario { flex: 2; min-width: 500px; }
        .calendario { width: 100%; border-collapse: collapse; }
        .calendario th { background: #3f51b5; color: white; padding: 8px; width: 14%; }
        .calendario td { border: 1px solid #ccc; height: 75px; vertical-align: top; padding: 4px; background: #fff; }
        .vazio { background: #f9f9f9; }
        .num-dia { font-weight: bold; font-size: 12px; color: #333; }
        .item-agenda { display: block; font-size: 10px; padding: 2px 4px; margin-top: 2px; color: white; text-decoration: none; border-radius: 3px; }
        .status-agendada { background: #0288d1; }
        .status-realizada { background: #388e3c; }
        .status-cancelada { background: #d32f2f; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main style="padding: 20px;">
        <h2>Dashboard</h2>

        <div class="dashboard-container">
            
            <!-- GRÁFICO FINANCEIRO -->
            <div class="card-grafico">
                <h3>Balanço Financeiro</h3>

                <!-- Barra de Entradas -->
                <div class="barra-grupo">
                    <div class="barra-label">
                        <span style="color: #2e7d32;">Entradas</span>
                        <span>R$ <?php echo number_format($totalEntradas, 2, ',', '.'); ?></span>
                    </div>
                    <div class="barra-fundo">
                        <div class="barra-preenchimento cor-entrada" style="width: <?php echo $pctEntradas; ?>%;"></div>
                    </div>
                </div>

                <!-- Barra de Saídas -->
                <div class="barra-grupo">
                    <div class="barra-label">
                        <span style="color: #c62828;">Saídas</span>
                        <span>R$ <?php echo number_format($totalSaidas, 2, ',', '.'); ?></span>
                    </div>
                    <div class="barra-fundo">
                        <div class="barra-preenchimento cor-saida" style="width: <?php echo $pctSaidas; ?>%;"></div>
                    </div>
                </div>

                <!-- Resumo Numérico -->
                <div class="resumo-cards">
                    <div class="resumo-box">
                        <small>Total Entradas</small>
                        <strong style="color: #2e7d32;">R$ <?php echo number_format($totalEntradas, 2, ',', '.'); ?></strong>
                    </div>
                    <div class="resumo-box">
                        <small>Total Saídas</small>
                        <strong style="color: #c62828;">R$ <?php echo number_format($totalSaidas, 2, ',', '.'); ?></strong>
                    </div>
                    <div class="resumo-box">
                        <small>Saldo Atual</small>
                        <strong style="color: <?php echo $saldo >= 0 ? '#2e7d32' : '#c62828'; ?>;">
                            R$ <?php echo number_format($saldo, 2, ',', '.'); ?>
                        </strong>
                    </div>
                </div>
            </div>

            <!-- CALENDÁRIO DA AGENDA -->
            <div class="card-calendario">
                <h3>Agenda</h3>
                <table class="calendario">
                    <tr>
                        <th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>
                    </tr>
                    <tr>
                    <?php
                    for ($i = 0; $i < $primeiroDiaSemana; $i++) {
                        echo '<td class="vazio"></td>';
                    }

                    $coluna = $primeiroDiaSemana;
                    for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                        echo '<td>';
                        echo '<div class="num-dia">' . $dia . '</div>';

                        if (isset($agenda[$dia])) {
                            foreach ($agenda[$dia] as $c) {
                                $nome = $c['paciente_nome'] ?? "Paciente " . $c['id_paciente'];
                                $hora = substr($c['hora'], 0, 5);
                                $statusClass = 'status-' . $c['status'];
                                echo "<a href='app/status.php?id={$c['id']}' class='item-agenda {$statusClass}'>{$hora} - {$nome}</a>";
                            }
                        }

                        echo '</td>';
                        $coluna++;
                        if ($coluna % 7 == 0) {
                            echo '</tr><tr>';
                        }
                    }

                    while ($coluna % 7 != 0) {
                        echo '<td class="vazio"></td>';
                        $coluna++;
                    }
                    ?>
                    </tr>
                </table>
            </div>

        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>