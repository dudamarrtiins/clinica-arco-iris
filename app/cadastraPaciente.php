<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>

   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    body {
        background-color: #fff3ed; /* Fundo bege */
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 20px 40px 20px;
        width: 100%;
        max-width: 850px;
        margin: 0 auto;
    }

    /* TÍTULO PRINCIPAL */
    h3 {
        font-size: 24px;
        color: #000000;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 30px;
    }

    /* FORMULÁRIO COMPLETO */
    form {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    /* ESTILO DOS RÓTULOS (LABELS) */
    label {
        font-size: 18px;
        font-weight: bold;
        color: #000000;
        margin-bottom: 8px;
        display: block;
    }

    /* INPUTS LARGOS (NOME, CPF, NASCIMENTO, CONVENIO, TELEFONE) */
    input[type="text"],
    input[type="date"] {
        width: 100%;
        height: 48px;
        background-color: #85b4f2; /* Azul padrão */
        border: none;
        border-radius: 18px;
        padding: 0 20px;
        font-size: 16px;
        color: #000000;
        outline: none;
        font-family: Georgia, 'Times New Roman', Times, serif;
        margin-bottom: 25px;
    }

    /* INPUT CURTO (IDADE) */
    input[type="number"] {
        width: 160px;
        height: 40px;
        background-color: transparent;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 0 12px;
        font-size: 16px;
        color: #000000;
        outline: none;
        font-family: Georgia, 'Times New Roman', Times, serif;
        margin-bottom: 25px;
    }

    /* SELECT CURTO (SEXO) */
    select {
        width: 160px;
        height: 40px;
        background-color: transparent;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 0 12px;
        font-size: 16px;
        color: #000000;
        outline: none;
        font-family: Georgia, 'Times New Roman', Times, serif;
        cursor: pointer;
        margin-bottom: 25px;
    }

    /* CONTAINER DOS BOTÕES INFERIORES */
    .botoes-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin-top: 20px;
    }

    /* BOTÕES CADASTRAR, LIMPAR E VOLTAR COMO PÍLULAS AZUIS */
    .botoes-container input[type="submit"],
    .botoes-container input[type="reset"],
    .botoes-container a {
        background-color: #85b4f2;
        color: #ffffff;
        border: none;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        font-family: Georgia, 'Times New Roman', Times, serif;
        padding: 12px 35px;
        border-radius: 15px;
        transition: opacity 0.2s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        text-decoration: none;
        display: inline-block;
    }

    .botoes-container input[type="submit"]:hover,
    .botoes-container input[type="reset"]:hover,
    .botoes-container a:hover {
        opacity: 0.9;
        text-decoration: none;
    }
</style>
</head>

<body>
    <?php 
    include __DIR__ . '/../includes/header.php';
    ?>

    <main>
        <h3>Cadastrar Paciente:</h3>
        
        <form action="" method="post">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome">

            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf">

            <label for="nasc">Nascimento: </label>
            <input type="date" name="nasc" id="nasc">

            <label for="idade">Idade: </label>
            <input type="number" name="idade" id="idade">

            <label for="convenio">Convenio: </label>
            <input type="text" name="convenio" id="convenio">

            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>

            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone">

            <div class="botoes-container">
                <input type="submit" value="Cadastrar">
                <input type="reset" value="Limpar">
                <a href="prontuario.php">Voltar</a>
            </div>
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