<?php 
    include 'conexao.php';

    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $rua = $_POST['txtRua'];
    $numero = $_POST['txtNumero'];
    $bairro = $_POST['txtBairro'];
    $cep = $_POST['txtCep'];
    $complemento = $_POST['txtComplemento'];
    $cidade = $_POST['txtCidade'];

    $sql = $pdo->prepare("INSERT INTO Loja (nome, telefone, 
    rua, numero, bairro, cep, complemento, cidade)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $sql->execute([$nome, $telefone, $rua, $numero, $bairro, $cep, $complemento, $cidade]);

    header("Location: lojas.php");
    exit;
?>