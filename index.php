<?php require_once __DIR__ . '/includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main>
        <h3>Faça login para continuar</h3>
        <form action="" method="post">
            <label for="email">E-mail: </label>
            <input type="text" name="email" id="email"><br>

            <label for="password">Senha: </label>
            <input type="text" name="senha" id="senha"><br>

            <input type="submit" value="Entar">

            <input type="reset" value="Limpar">

        </form> 

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $usuario = consulta_user($conexao, $_POST['email']);

            if($usuario['email'] == $_POST['email'] && $usuario['senha'] == $_POST ['senha']){

                session_start();
                $_SESSION['id'] = $usuario['id'];
                header("Location: ../index.php");
                exit();

            } else {
                echo "Usúario ou senha inválidos.";
            }
        }
        ?>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>