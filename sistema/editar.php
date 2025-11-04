<?php 
include 'conexao.php';
$id = $_POST['btnEditar'];
$sql = $pdo->prepare("SELECT * FROM Produto WHERE id = ?");
$sql->execute([$id]);
$linha = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar o produto: <?php echo $linha['nome']?></h1>

    <div class="container">
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id"
            value="<?php echo $linha['id']?>">

            <input type="text" name="nome" 
            value="<?php echo $linha['nome']?>">

            <input type="text" name="descricao"
            value="<?php echo $linha['descricao']?>">

            <input type="text" name="preco"
            value="<?php echo $linha['preco']?>">

            <input type="text" name="tipo"
            value="<?php echo $linha['tipo']?>">
            
            <input type="text" name="categoria"
            value="<?php echo $linha['categoria']?>">

            <input type="date" name="data"
            value="<?php echo $linha['data_lancamento']?>">

            <input type="text" name="desconto"
            value="<?php echo $linha['desconto_usados']?>">

            <input type="submit" name="btnSalvar" value="Salvar"
            class="btn btn-primary">
        </form>
    </div>

</body>
</html>