<?php
    include 'conexao.php';
    $id = $_POST['id'];
    $nome = $_POST['txtNome'];
    $descricao = $_POST['txtDescricao'];
    

    $sql = $pdo->prepare("UPDATE Caracteristica SET nome = ?, descricao = ? WHERE id = ?");
    $sql->execute([$nome, $descricao, $id]);
    //echo $sql . "<<<<<<<<<<<<<<<<<<<<<";
    header("Location: caracteristicas.php");
    exit;
?>