<?php

// Seleciona o ambiente da aplicação.
// Se APP_ENV não estiver definida, utiliza o ambiente local.
$ambiente = getenv('APP_ENV') ?: 'local';

// Carrega a configuração correspondente ao ambiente.
if ($ambiente === 'escola') {
    require_once __DIR__ . '/config.php';
} elseif ($ambiente === 'local') {
    require_once __DIR__ . '/configLocal.php';
} else {
    http_response_code(500);
    exit('Erro: ambiente da aplicação inválido.');
}

try {
    // Define a porta padrão do PostgreSQL, caso não esteja configurada.
    $port = defined('DB_PORT') ? DB_PORT : '5432';

    // Monta a string de conexão com o PostgreSQL.
    $dsn = 'pgsql:host=' . DB_HOST
         . ';port=' . $port
         . ';dbname=' . DB_NAME;

    // Estabelece a conexão com o banco de dados.
    $conexao = new PDO(
        $dsn,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {
    error_log('ERRO PDO: ' . $e->getMessage());

    echo '<pre>';
    echo htmlspecialchars(
        $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    );
    echo '</pre>';

    exit;
}
?>
