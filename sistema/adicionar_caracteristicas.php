<?php 
    include 'conexao.php';

    $nome = $_POST['txtNome'];
    $descricao = $_POST['txtDescricao'];


    $sql = $pdo->prepare("INSERT INTO Caracteristica (nome, descricao)
    VALUES (?, ?)");

    $sql->execute([$nome, $descricao]);

    header("Location: caracteristicas.php");
    exit;
?>