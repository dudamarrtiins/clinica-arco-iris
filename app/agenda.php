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
            background-color: #fff3ed; /* Fundo Bege */
            min-height: 100vh;
        }

        /* SEGUNDA FAIXA AZUL DO TOPO: BEM FININHA E ESPAÇADA */
        .submenu-topo {
            background-color: #72a9ed;
            padding: 4px 0;      /* Espessura bem fininha */
            margin-top: 15px;    /* Espaço do nav principal */
            text-align: center;
        }

        .submenu-topo a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
            margin: 0 30px;
        }

        main {
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centraliza as caixinhas na tela */
            gap: 30px;          /* Espaçamento entre os cards */
        }

        /* CAIXINHA AZUL FLUTUANTE (Formulário) */
        .card-agendamento {
            background-color: #72a9ed;
            padding: 25px 30px;
            border-radius: 25px; /* Cantos arredondados */
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* Efeito flutuante */
        }

        .card-agendamento h3 {
            text-align: center;
            font-size: 20px;
            font-weight: normal;
            margin-bottom: 20px;
            color: #000;
        }

        .card-agendamento label {
            display: block;
            font-size: 17px;
            margin-top: 12px;
            margin-bottom: 6px;
            color: #000;
        }

        .card-agendamento input[type="text"],
        .card-agendamento input[type="tel"] {
            width: 100%;
            background-color: #d9d9d9;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 15px;
            outline: none;
        }

        .grupo-convenio {
            margin-top: 18px;
            font-size: 17px;
            color: #000;
        }

        .grupo-convenio input[type="radio"] {
            margin-left: 10px;
            margin-right: 5px;
        }

        .btn-agendar {
            display: block;
            width: 100%;
            background-color: #ffffff;
            color: #000;
            border: none;
            padding: 10px;
            border-radius: 20px;
            font-size: 16px;
            margin-top: 22px;
            cursor: pointer;
        }

        /* CAIXINHA AZUL FLUTUANTE (Dados do Paciente) */
        .card-paciente {
            background-color: #72a9ed;
            color: #000;
            padding: 25px 30px;
            border-radius: 25px; /* Cantos arredondados */
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* Efeito flutuante */
        }

        .card-paciente h4 {
            font-size: 18px;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding-bottom: 8px;
        }

        .card-paciente p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        /* Ações dentro do card do paciente */
        .acoes-card {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid rgba(0,0,0,0.1);
            text-align: center;
            font-size: 14px;
        }

        .acoes-card a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
            margin: 0 5px;
        }

        .acoes-card a:hover {
            text-decoration: underline;
        }
    </style>
    
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <h2>Agenda de Atendimentos</h2>

        <a href="agendamento.php"> + Novo Atendimento</a>
        <br><br>

        <?php if (empty($consultas)): 
            else:
            ?>
            <p>Nenhuma consulta agendada.</p>
            <?php
                foreach ($consultas as $c): ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <p><strong>Paciente:</strong> <?php echo $c['paciente_nome'] ?? "ID Paciente: " . $c['id_paciente']; ?></p>
                    <p><strong>Data:</strong> <?php echo $c['dia']; ?> às <?php echo $c['hora']; ?></p>
                    <p><strong>Status:</strong> <?php echo $c['status']; ?></p>


                    <nav>
                    <a href="status.php?acao=realizada&id=<?php echo $c['id']; ?>">Consulta Realizada</a> | 

                    <a href="status.php?acao=cancelar&id=<?php echo $c['id']; ?>">Cancelar Consulta</a> | 

                    <a href="remarcar.php?id=<?php echo $c['id']; ?>">Remarcar</a> | 

                    <a href="status.php?acao=deletar&id=<?php echo $c['id']; ?>" onclick="return confirm('Tem certeza que deseja apagar?');">Apagar</a>

                    </nav>


                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>