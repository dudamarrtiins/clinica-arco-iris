<?php
require_once __DIR__ . '/../includes/functions.php';
?>

<!-- VISUALIZAR SEM O W-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prontuario</title>
</head>

<body>
    <?php  include __DIR__ . '/../includes/header.php';
        include __DIR__ .'/../includes/headerProntuario.php';
    ?>
    <main>
        <?php
        prontuario($conexao);
        ?>
    </main>
    
    <?php include __DIR__ . '/../includes/footer.php';?>
</body>

</html>