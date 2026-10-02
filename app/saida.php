<?php 
require_once __DIR__ . '/../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saida</title>
</head>
<body>
    <?php 
    include __DIR__ . '/../includes/header.php';
    ?>
    <br><a href="/app/gestao.php">Voltar</a>
    <main>
        <h2>Adicione o valor da saida:</h2>

        <form action="" method="post">
            <label for="saida">Valor da saida: </label>
            <input type="text" name="saida" id="saida"><br>

            <label for="dia">Dia: </label>
            <input type="date" name="dia" id="dia"><br>

            <br><input type="submit" value="Salvar">

            <input type="reset" value="Cancelar">

        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            saida($conexao, $_POST['saida'], $_POST['dia']);
        }
        ?>

    </main>
    
</body>
</html>