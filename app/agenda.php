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
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <h2>Agenda de Consultas</h2>

        <a href="agendamento.php">+ Novo Atendimento</a>
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

                    <!-- Links das Ações -->
                    <a href="acoes_agenda.php?acao=realizada&id=<?php echo $c['id']; ?>">Marcar Realizada</a> | 

                    <a href="acoes_agenda.php?acao=cancelar&id=<?php echo $c['id']; ?>">Cancelar Consulta</a> | 

                    <a href="editar_consulta.php?id=<?php echo $c['id']; ?>">Remarcar</a> | 

                    <a href="acoes_agenda.php?acao=deletar&id=<?php echo $c['id']; ?>" onclick="return confirm('Tem certeza que deseja apagar?');">Apagar</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>