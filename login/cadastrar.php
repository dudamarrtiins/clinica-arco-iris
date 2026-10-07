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
</head>

<body>

    <main>
        <h3>Cadastre-se no Sistema:</h3>
        <form action="" method="post">
            <label for="email">E-mail: </label>
            <input type="text" name="email" id="email" required><br>

            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required><br>

            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </form>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>