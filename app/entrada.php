<?php 
require_once __DIR__ . '/../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
</head>
<body>
    <?php 
    include __DIR__ . '/../includes/header.php';
    ?>

    <br><a href="/app/gestao.php">Voltar</a>
    <main>
        <h2>Adicione o valor da entrda:</h2>
    
        <form action="" method="post">
            <label for="entrada">Valor da entrada: </label>
            <input type="text" name="entrada" id="entrada"><br>

            <label for="dia">Dia: </label>
            <input type="date" name="dia" id="dia"><br>

            <br><input type="submit" value="Registrar Ganho">

            <input type="reset" value="Cancelar">

        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            entrada($conexao, $_POST['entrada'], $_POST['dia']);
        }
        ?>

    </main>
    
</body>
</html>