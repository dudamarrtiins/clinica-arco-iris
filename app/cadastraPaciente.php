<?php
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php';
    include __DIR__ .'/../includes/headerProntuario.php';
    ?>

    <main>
        <h3>Cadastrar Paciente:</h3>
        <form action="" method="post">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome"><br>

            
            <br><label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf"><br>

            
            <br><label for="nasc">Nascimento: </label>
            <input type="date" name="nasc" id="nasc"><br>

            
            <br><label for="idade">Idade: </label>
            <input type="number" name="idade" id="idade"><br>

            
            <br><label for="convenio">Convenio: </label>
            <input type="text" name="convenio" id="convenio"><br>

            
            <br><label for="sexo">Sexo:</label>

            <select name="sexo" id="sexo" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select><br>

            <br><label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone"><br>

            
            <br><input type="submit" value="Cadastrar">

            <input type="reset" value="Limpar">

        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            cadastrar($conexao, $_POST['nome'], $_POST['cpf'], $_POST['nasc'], $_POST['idade'], $_POST['convenio'], $_POST['sexo'], $_POST['telefone']);
        }
        ?>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>