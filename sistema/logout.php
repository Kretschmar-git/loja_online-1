<?php
session_start(); // 1. Recupera a sessão atual

// 2. Limpa todas as variáveis da sessão (remove id_cliente, nome, etc.)
$_SESSION = array();

// 3. Destrói a sessão completamente no servidor
session_destroy();

// 4. Redireciona o usuário de volta para a tela de login
header("Location: login.php");
exit;
?>