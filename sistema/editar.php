<?php 
include 'conexao.php';


$id = $_POST['btnEditar'];
$sql = $pdo->prepare("SELECT * FROM Produto WHERE id = ?");
$sql->execute([$id]);
$linha = $sql->fetch(PDO::FETCH_ASSOC);



$sql = $pdo->prepare("SELECT COLUMN_TYPE
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = ?
  AND TABLE_NAME = ?
  AND COLUMN_NAME = ?;");


$sql->execute([$banco, 'produto', 'tipo']);
$colunaTipo = $sql->fetchColumn();

$enumValues = [];
if (strpos($colunaTipo, 'enum') === 0 || strpos($colunaTipo, 'set') === 0) {
    // Extrai a string de opções entre parênteses
    $start = strpos($colunaTipo, '(') + 1;
    $end = strrpos($colunaTipo, ')');
    $optionsString = substr($colunaTipo, $start, $end - $start);
    // Separa as opções e remove as aspas simples
    $enumValues = explode(',', str_replace("'", "", $optionsString));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
         <title>Editar Produto</title>
</head>
<body>
    <div class="container my-4">
        <h1>Editar o produto: <?php echo $linha['nome']?></h1>
            <form action="atualizar.php" method="POST">
                    <input type="hidden" name="id"
                    value="<?php echo $linha['id']?>" class="form-control">

                <div class="mb-3">
                    <label for="txtNome" class="form-label">Nome do Produto</label>
                    <input type="text" name="nome" id="txtNome"
                    value="<?php echo $linha['nome']?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="txtDescricao" class="form-label">Descrição do Produto</label>
                    <input type="text" name="descricao" id="txtDescricao"
                    value="<?php echo $linha['descricao']?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="txtPreco" class="form-label">Preço</label>
                    <input type="text" name="preco" id="txtPreco"
                    value="<?php echo $linha['preco']?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="txtTipo" class="form-label">Tipo</label>
                    <select name="tipo" id="txtTipo" class="form-select form-select-lg">
                        <option value="">Selecione um tipo...</option>
                        <?php 
                            foreach ($enumValues as $tipo) {
                                $tipo = trim($tipo);
                                // Verifica se é o valor atual do produto para marcá-lo como selecionado
                                $selected = ($linha['tipo'] == $tipo) ? 'selected' : '';
                                echo "<option value=\"{$tipo}\" {$selected}>" . ucfirst($tipo) . "</option>";
                            }
                        ?>
                    </select>
                </div>
            
                <div class="mb-3">
                    <label for="txtCategoria" class="form-label">Categoria</label>
                    <input type="text" name="categoria" id="txtCategoria"
                    value="<?php echo $linha['categoria']?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="txtData" class="form-label">Data de Lançamento</label>
                    <input type="date" name="data" id="txtData"
                    value="<?php echo $linha['data_lancamento']?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="txtDesconto" class="form-label">Descontos Usados</label>
                    <input type="text" name="desconto" id="txtDesconto"
                    value="<?php echo $linha['desconto_usados']?>" class="form-control">
                </div>

                <input type="submit" name="btnSalvar" value="Salvar"
                class="btn btn-primary">
            </form>
     </div>

</body>
</html>