<?php 
require_once __DIR__ . '/../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        body {
            background-color: #fff3ed; /* Fundo bege da imagem */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 30px 40px;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        /* FORMULÁRIO COMPLETO */
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        /* TÍTULOS E LABELS */
        h2, label {
            font-size: 18px;
            color: #000000;
            font-weight: bold;
            margin-bottom: 12px;
            display: block;
        }

        h2 {
            margin-bottom: 15px;
        }

        .campo-grupo {
            margin-bottom: 35px;
            width: 100%;
        }

        /* INPUTS (VALOR E DIA) - PÍLULAS AZUIS LARGAS */
        input[type="text"],
        input[type="date"] {
            width: 100%;
            height: 48px;
            background-color: #85b4f2; /* Azul exato do protótipo */
            border: none;
            border-radius: 18px;
            padding: 0 20px;
            font-size: 16px;
            color: #000000;
            outline: none;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        /* ÁREA DE BOTÕES INFERIOR */
        .botoes-container {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-top: 10px;
        }

        /* BOTÕES DE TEXTO (REGISTRAR GANHO E CANCELAR) */
        input[type="submit"],
        input[type="reset"] {
            background: none;
            border: none;
            color: #000000;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            font-family: Georgia, 'Times New Roman', Times, serif;
            padding: 0;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            text-decoration: underline;
        }

        /* BOTÃO VOLTAR (PÍLULA AZUL) */
        .btn-voltar {
            background-color: #85b4f2;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 30px;
            border-radius: 15px;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-voltar:hover {
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
        <form action="" method="post">
            
            <h2>Adicione o valor da entrada:</h2>
            <div class="campo-grupo">
                <input type="text" name="entrada" id="entrada" required>
            </div>

            <label for="dia">Dia:</label>
            <div class="campo-grupo">
                <input type="date" name="dia" id="dia" required>
            </div>

            <div class="botoes-container">
                <input type="submit" value="Registrar Ganho">
                <input type="reset" value="Cancelar">
                <a href="/app/gestao.php" class="btn-voltar">Voltar</a>
            </div>

        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            entrada($conexao, $_POST['entrada'], $_POST['dia']);
        }
        ?>

    </main>
    
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>