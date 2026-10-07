<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../includes/functions.php';

$id_consulta = $_GET['id'] ?? null;

if (!$id_consulta) {
    header("Location: agenda.php");
    exit();
}

// Processa a atualização
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_dia = $_POST['dia'];
    $nova_hora = $_POST['hora'];

    if (remarcarConsulta($conexao, $id_consulta, $novo_dia, $nova_hora)) {
        header("Location: agenda.php");
        exit();
    } else {
        $erro = "Erro ao remarcar consulta.";
    }
}

// Busca os dados atuais da consulta
$stmt = $conexao->prepare("SELECT * FROM consultas WHERE id = :id");
$stmt->bindParam(':id', $id_consulta);
$stmt->execute();
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Remarcar Consulta</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main>
        <h2>Remarcar Consulta #<?php echo $consulta['id']; ?></h2>

        <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

        <form method="POST" action="">
            <label for="dia">Nova Data:</label>
            <input type="date" name="dia" id="dia" value="<?php echo $consulta['dia']; ?>" required><br><br>

            <label for="hora">Novo Horário:</label>
            <input type="time" name="hora" id="hora" value="<?php echo $consulta['hora']; ?>" required><br><br>

            <input type="submit" value="Atualizar Agendamento">
            <a href="agenda.php">Cancelar</a>
        </form>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>