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
    $sql = $pdo->query("SELECT * FROM Produto");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Página Principal</title>
</head>

<body>

    <div class="container">
        
        <a href="index.php" class="text-decoration-none">
            <h1 class="display-5 text-primary">Página Principal</h1>
        </a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data de Lançamento</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['id']?></th>
                    <td><?php echo $linha['nome']?></td>
                    <td><?php echo $linha['descricao'] ?></td>
                    <td><?php echo $linha['preco'] ?></td>
                    <td><?php echo $linha['tipo'] ?></td>
                    <td><?php echo $linha['categoria'] ?></td>
                    <td><?php 
                        $partes = explode('-', $linha['data_lancamento']);
                        $data = "".$partes[2]."/".$partes[1]."/".$partes[0];
                        echo $data ?>
                    </td>
                    <td><?php echo $linha['desconto_usados'] ?></td>
                    <td><form action="editar.php" method="POST">
                        <button class="btn btn-primary" name="btnEditar" 
                        value="<?php echo $linha['id'];?>">Editar</button>
                    </form></td>

                    <td><form action="excluir.php" method="POST"> 
                        <button class="btn btn-danger" name="btnExcluir" 
                        value="<?php echo $linha['id'];?>">Excluir</button>
                    </form></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6"> 

                    <form action="adicionar.php" method="POST">
                        <h3 class="mb-4">Cadastro de Produto</h3>
                        
                        <div class="mb-3">
                            <label for="txtNome" class="form-label">Nome do Produto</label>
                            <input type="text" name="txtNome" id="txtNome"
                                class="form-control"
                                placeholder="Digite o nome do produto.." required>
                        </div>

                        <div class="mb-3">
                            <label for="txtDescricao" class="form-label">Descrição do Produto</label>
                            <input type="text" name="txtDescricao" id="txtDescricao"
                                class="form-control"
                                placeholder="Digite a descrição do produto.." required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="txtPreco" class="form-label">Preço</label>
                            <input type="number" name="txtPreco" id="txtPreco"
                                class="form-control"
                                placeholder="Digite o preço do produto.."
                                step="0.01" min="0"> 
                        </div>

                        <div class="mb-3">
                            <label for="txtTipo" class="form-label">Tipo</label>
                            <input type="text" name="txtTipo" id="txtTipo"
                                class="form-control"
                                placeholder="Digite o tipo do produto..">
                        </div>

                        <div class="mb-3">
                            <label for="txtCategoria" class="form-label">Categoria</label>
                            <input type="text" name="txtCategoria" id="txtCategoria"
                                class="form-control"
                                placeholder="Digite a categoria do produto..">
                        </div>

                        <div class="mb-3">
                            <label for="txtData" class="form-label">Data de Lançamento</label>
                            <input type="date" name="txtData" id="txtData"
                                class="form-control"
                                placeholder="Digite a data de lançamento..">
                        </div>

                        <div class="mb-3">
                            <label for="txtDesconto" class="form-label">Descontos Usados</label>
                            <input type="number" name="txtDesconto" id="txtDesconto"
                                class="form-control"
                                placeholder="Digite os descontos usados.."
                                step="0.01" min="0">
                        </div>

                        <input type="submit" value="Salvar" name="btnSalvar" class="btn btn-success">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>