<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../includes/functions.php';

$acao = $_GET['acao'] ?? null;
$id = $_GET['id'] ?? null;

if ($acao && $id) {
    if ($acao == 'cancelar') {
        cancelarConsulta($conexao, $id);
    } elseif ($acao == 'realizada') {
        atualizarStatusConsulta($conexao, $id, 'realizada');
    } elseif ($acao == 'deletar') {
        deletarConsulta($conexao, $id);
    }
}

header("Location: agenda.php");
exit();