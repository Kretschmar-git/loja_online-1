<?php
    include 'conexao.php';
    $id = $_POST['id'];
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $rua = $_POST['txtRua'];
    $numero = $_POST['txtNumero'];
    $bairro = $_POST['txtBairro'];
    $cep = $_POST['txtCep'];
    $complemento = $_POST['txtComplemento'];
    $cidade = $_POST['txtCidade'];

    $sql = $pdo->prepare("UPDATE Loja SET nome = ?, telefone = ?, 
    rua = ?, numero = ?, bairro = ?, cep = ?, 
    complemento = ?, cidade = ? WHERE id = ?");
    $sql->execute([$nome, $telefone, $rua, $numero, $bairro, $cep, $complemento, $cidade, $id]);
    //echo $sql . "<<<<<<<<<<<<<<<<<<<<<";
    header("Location: lojas.php");
    exit;
?>