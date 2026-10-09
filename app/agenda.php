<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../includes/functions.php';

$consultas = listarConsultas($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        body {
            background-color: #fff3ed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
        }

        .agenda-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .agenda-header h2 {
            font-size: 26px;
            color: #000000;
            font-weight: bold;
        }

        .btn-novo-atendimento {
            color: #72a9ed;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            margin-bottom: 30px;
            display: inline-block;
        }

        .btn-novo-atendimento:hover {
            text-decoration: underline;
        }

        /* CONTAINER DE CADA CONSULTA */
        .bloco-consulta-item {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
        }

        /* CAIXINHA DO PACIENTE */
        .card-paciente-azul {
            background-color: #85b4f2;
            width: 100%;
            max-width: 420px;
            padding: 25px 30px;
            border-radius: 18px;
            margin-bottom: 35px;
        }

        .card-paciente-azul p {
            color: #000000;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .card-paciente-azul p:last-child {
            margin-bottom: 0;
        }

        /* BARRA DE AÇÕES SOLTA EMBAIXO */
        .barra-acoes-azul {
            background-color: #85b4f2;
            width: 100%;
            max-width: 900px;
            padding: 16px 20px;
            border-radius: 18px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .barra-acoes-azul a {
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }

        .barra-acoes-azul a:hover {
            text-decoration: underline;
        }

        .mensagem-vazia {
            font-size: 18px;
            font-weight: bold;
            color: #000000;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <div class="agenda-header">
            <h2>Agenda de Atendimentos</h2>
        </div>

        <a href="agendamento.php" class="btn-novo-atendimento"> + Novo Atendimento</a>

        <?php if (empty($consultas)): ?>
            <p class="mensagem-vazia">Nenhuma consulta agendada.</p>
        <?php else: ?>
            <?php foreach ($consultas as $c): ?>
                <div class="bloco-consulta-item">
                    
                    <!-- Card de informações do paciente -->
                    <div class="card-paciente-azul">
                        <p><strong>Paciente:</strong> <?php echo $c['paciente_nome'] ?? "ID Paciente: " . $c['id_paciente']; ?></p>
                        <p><strong>Data:</strong> <?php echo $c['dia']; ?> às <?php echo $c['hora']; ?></p>
                        <p><strong>Status:</strong> <?php echo $c['status']; ?></p>
                    </div>

                    <!-- Barra de botões separada -->
                    <nav class="barra-acoes-azul">
                        <a href="status.php?acao=realizada&id=<?php echo $c['id']; ?>">Consulta Realizada</a>
                        <a href="status.php?acao=cancelar&id=<?php echo $c['id']; ?>">Cancelar Consulta</a>
                        <a href="remarcar.php?id=<?php echo $c['id']; ?>">Remarcar</a>
                        <a href="status.php?acao=deletar&id=<?php echo $c['id']; ?>" onclick="return confirm('Tem certeza que deseja apagar?');">Apagar</a>
                    </nav>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>