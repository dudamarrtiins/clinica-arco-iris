<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../includes/functions.php';

// Busca lista de pacientes para o seletor (dropdown)
$stmtP = $conexao->prepare("SELECT id, nome FROM paciente ORDER BY nome ASC");
$stmtP->execute();
$pacientes = $stmtP->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_paciente = $_POST['id_paciente'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];

    if (agendarConsulta($conexao, $id_paciente, $dia, $hora)) {
        header("Location: agenda.php");
        exit();
    } else {
        $erro = "Erro ao realizar agendamento.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Agendamento</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <h2>Marcar Novo Atendimento</h2>

        <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

        <form method="POST" action="">
            <label for="id_paciente">Paciente:</label>
            <select name="id_paciente" id="id_paciente" required>
                <option value="">-- Selecione o Paciente --</option>
                <?php foreach ($pacientes as $p): ?>
                    <option value="<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="dia">Data:</label>
            <input type="date" name="dia" id="dia" required><br><br>

            <label for="hora">Horário:</label>
            <input type="time" name="hora" id="hora" required><br><br>

            <input type="submit" value="Salvar Consulta">
            <a href="agenda.php">Voltar</a>
        </form>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>