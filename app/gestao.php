<?php 
require_once __DIR__ . '/../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        body {
            background-color: #fff3ed; /* Fundo bege padrão */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 40px 20px;
            width: 100%;
        }

        /* TÍTULO PRINCIPAL */
        h1 {
            font-size: 26px;
            color: #000000;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        /* BARRA AZUL DE AÇÕES (PÍLULA LARGA) */
        .barra-gestao-acoes {
            background-color: #85b4f2;
            width: 100%;
            max-width: 850px;
            padding: 18px 25px;
            border-radius: 18px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .barra-gestao-acoes a {
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }

        .barra-gestao-acoes a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php 
    include __DIR__ . '/../includes/header.php';
    ?>

    <main>
        <h1>Painel de Gestão Financeira</h1>

        <!-- BARRA AZUL COM SEUS LINKS DE AÇÃO -->
        <div class="barra-gestao-acoes">
            <a href="/app/entrada.php">Registrar Ganho</a>
            <a href="/app/saida.php">Registrar Gasto</a>
            <a href="/app/extrato.php">Ver extrato</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>