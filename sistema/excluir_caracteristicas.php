<?php
    include 'conexao.php';
    $id = $_POST['btnExcluir'];


    // APAGAR estoque SE EXISTIR
    $sql = $pdo->prepare("DELETE FROM Produto_Caracteristica WHERE id_caracteristica = ?");
    $sql->execute([$id]);

    // APAGAR O Produto
    $sql = $pdo->prepare("DELETE FROM Caracteristica WHERE id = ?");
    $sql->execute([$id]);

    header("Location: caracteristicas.php");
    exit;
?>