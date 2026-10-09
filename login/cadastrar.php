<?php 
require_once __DIR__ . '/../includes/functions.php';

// Trata o envio do formulário ANTES de qualquer HTML ser renderizado
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // 1. Executa a função de cadastro
    $id_novo_usuario = cadastrar_user($conexao, $_POST['email'], $_POST['senha']);
    
    // 2. Inicia a sessão e faz o "login automático" do usuário cadastrado
    session_start();
    $_SESSION['id'] = $id_novo_usuario; // Salva a sessão para o painel permitir o acesso
    
    // 3. Redireciona para o painel dentro da pasta app/
    header("Location: ../painel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>

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
            align-items: center;
        }

        /* FAIXA AZUL DO TOPO */
        .header-topo {
            width: 100%;
            height: 65px;
            background-color: #85b4f2; /* Azul exato do protótipo */
        }

        /* CONTEÚDO PRINCIPAL */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
            padding: 20px;
        }

        /* TÍTULO "Cadastre-se no Sistema:" */
        h3 {
            font-size: 24px;
            color: #000000;
            margin-top: 15px;
            margin-bottom: 25px;
            font-weight: bold;
            text-align: center;
        }

        /* CAIXINHA AZUL FLUTUANTE (CARD DO FORMULÁRIO) */
        .card-cadastro {
            background-color: #85b4f2;
            width: 100%;
            max-width: 480px;
            padding: 35px 40px;
            border-radius: 18px; /* Cantos bem arredondados */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* LINHA DO FORMULÁRIO (LABEL + INPUT LADO A LADO) */
        .campo-grupo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .campo-grupo label {
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            width: 80px;
            text-align: right;
            margin-right: 15px;
        }

        /* CAMPOS DE TEXTO BRANCOS ARREDONDADOS */
        .campo-grupo input {
            flex: 1;
            background-color: #ffffff;
            border: none;
            height: 38px;
            border-radius: 20px; /* Arredondado estilo pílula */
            padding: 0 15px;
            font-size: 16px;
            outline: none;
        }

        /* ÁREA DOS BOTÕES (CADASTRAR / LIMPAR ESTILO PÍLULA FOTO 2) */
        .botoes-grupo {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 30px;
            gap: 20px;
        }

        .botoes-grupo input[type="submit"],
        .botoes-grupo input[type="reset"] {
            background-color: #ffffff;
            color: #85b4f2;
            border: none;
            padding: 10px 28px;
            border-radius: 18px; /* Formato pílula idêntico à foto 2 */
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            font-family: Georgia, 'Times New Roman', Times, serif;
            transition: opacity 0.2s;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .botoes-grupo input[type="submit"]:hover,
        .botoes-grupo input[type="reset"]:hover {
            opacity: 0.9;
        }

    </style>
</head>

<body>

<!--faixa azul-->
<div class="header-topo"></div>
    <main>
        <h3>Cadastre-se no Sistema:</h3>

        <div class="card-cadastro">
            <form action="" method="post">

                <div class="campo-grupo">
                    <label for="email">E-mail: </label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="campo-grupo">
                    <label for="senha">Senha: </label>
                    <input type="password" name="senha" id="senha" required>
                </div>

                <div class="botoes-grupo">
                    <input type="submit" value="Cadastrar">
                    <input type="reset" value="Limpar">
                </div>

            </form>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>