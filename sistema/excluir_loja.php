<?php
    include 'conexao.php';
    $id = $_POST['btnExcluir'];


    // APAGAR estoque SE EXISTIR
    $sql = $pdo->prepare("DELETE FROM Estoque WHERE id_loja = ?");
    $sql->execute([$id]);

    // APAGAR O Produto
    $sql = $pdo->prepare("DELETE FROM Loja WHERE id = ?");
    $sql->execute([$id]);

    header("Location: lojas.php");
    exit;
?>