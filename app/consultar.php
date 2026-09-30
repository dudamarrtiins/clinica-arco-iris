<?php 
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Usuario</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Consultar Paciente</h1>
    <main>
    <form action="" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" nome="nome" placeholder="Insira o nome para consultar" require><br>
        <input type="submit" value="Consultar">
    </form>
    <?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
    consultar($conexao, $_POST['nome']);
    }
    ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>


