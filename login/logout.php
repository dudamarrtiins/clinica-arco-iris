<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$_SESSION = array();
session_destroy(); // destroi a sessão atual

header("Location: ../index.php"); //redireciona para o index
exit(); // sai
?>