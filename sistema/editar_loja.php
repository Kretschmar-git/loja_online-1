<?php
session_start();

// Verifica se está logado
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit;
}
?>
<?php 
include 'conexao.php';
$id = $_POST['btnEditar'];
$sql = $pdo->prepare("SELECT * FROM Loja WHERE id = ?");
$sql->execute([$id]);
$linha = $sql->fetch(PDO::FETCH_ASSOC);


$sql = $pdo->prepare("SELECT COLUMN_TYPE
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = ?
  AND TABLE_NAME = ?
  AND COLUMN_NAME = ?;");

$sql->execute([$banco, 'Loja', 'tipo']);
$colunaTipo = $sql->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Editar Loja</title>
</head>
<body>
    <div class="container my-4">
        <h1>Editar a Loja: <?php echo $linha['nome']?></h1>
        <form action="atualizar_loja.php" method="POST">
            <input type="hidden" name="id"
            value="<?php echo $linha['id']?>" class="form-control">

            <input type="text" name="txtNome" 
            value="<?php echo $linha['nome']?>" class="form-control">

            <input type="text" name="txtTelefone"
            value="<?php echo $linha['telefone']?>" class="form-control">

            <input type="text" name="txtRua"
            value="<?php echo $linha['rua']?>" class="form-control">

            <input type="text" name="txtNumero"
            value="<?php echo $linha['numero']?>" class="form-control">
            
            <input type="text" name="txtBairro"
            value="<?php echo $linha['bairro']?>" class="form-control">

            <input type="text" name="txtCep"
            value="<?php echo $linha['cep']?>" class="form-control">

            <input type="text" name="txtComplemento"
            value="<?php echo $linha['complemento']?>" class="form-control">

            <input type="text" name="txtCidade"
            value="<?php echo $linha['cidade']?>" class="form-control">

            <input type="submit" name="btnSalvar" value="Salvar"
            class="btn btn-primary">
        </form>
    </div>

</body>
</html>