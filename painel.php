<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <?php require_once __DIR__ .'/includes/header.php';?>
<!-- utilizando o require_once importasse o header que utilizamos como nav, se o require não rodar a pagina não abre pois o nav é essencial! FUNCIONA-->

    <main>
        <article>
            <h1>Seja bem vindo(a)!</h1>
            <h2>Utilize o menu superior para navegar</h2>
        </article>
    </main>

    <?php include __DIR__ .'/includes/footer.php';?>
<!-- Importando o footer, utilizamos o include pois se não caregar o footer a pagina funciona normalmente, FUNCIONA-->
</body>
</html>