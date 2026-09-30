<?php 
require_once __DIR__ . '/../includes/functions.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apaga Paciente</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php';  // inclui o header
        include __DIR__ .'/../includes/headerProntuario.php';
    ?> 

    <h1>Apagar Paciente</h1>
    <main>
    <form action="" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Insira o nome completo" require><br>
        <input type="submit" value="Apagar">
    </form> <!-- Forms simples-->
    <?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
    apagar($conexao, $_POST['nome']);
    }
    ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
