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
    $sql = $pdo->query("SELECT * FROM Loja");
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
                    <th scope="col">Telefone</th>
                    <th scope="col">rua</th>
                    <th scope="col">numero</th>
                    <th scope="col">bairro</th>
                    <th scope="col">cep</th>
                    <th scope="col">complemento</th>
                    <th scope="col">cidade</th>
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
                    <td><?php echo $linha['telefone'] ?></td>
                    <td><?php echo $linha['rua'] ?></td>
                    <td><?php echo $linha['numero'] ?></td>
                    <td><?php echo $linha['bairro'] ?></td>
                    <td><?php echo $linha['cep'] ?></td>
                    <td><?php echo $linha['complemento'] ?></td>
                    <td><?php echo $linha['cidade'] ?></td>
                    <td><form action="editar_loja.php" method="POST">
                        <button class="btn btn-primary" name="btnEditar" 
                        value="<?php echo $linha['id'];?>">Editar</button>
                    </form></td>

                    <td><form action="excluir_loja.php" method="POST"> 
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

                    <form action="adicionar_loja.php" method="POST">
                        <h3 class="mb-4">Cadastro de Produto</h3>
                        
                        <div class="mb-3">
                            <label for="txtNome" class="form-label">Nome do Produto</label>
                            <input type="text" name="txtNome" id="txtNome"
                                class="form-control"
                                placeholder="Digite o nome da loja.." required>
                        </div>

                        <div class="mb-3">
                            <label for="txtTelefone" class="form-label">Telefone</label>
                            <input type="text" name="txtTelefone" id="txtTelefone"
                                class="form-control"
                                placeholder="Digite o telefone.." required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="txtRua" class="form-label">Rua</label>
                            <input type="text" name="txtRua" id="txtRua"
                                class="form-control"
                                placeholder="Digite a rua da loja.."> 
                        </div>

                        <div class="mb-3">
                            <label for="txtNumero" class="form-label">Número</label>
                            <input type="text" name="txtNumero" id="txtNumero"
                                class="form-control"
                                placeholder="Digite o número da loja..">
                        </div>

                        <div class="mb-3">
                            <label for="txtBairro" class="form-label">Bairro</label>
                            <input type="text" name="txtBairro" id="txtBairro"
                                class="form-control"
                                placeholder="Digite o bairro..">
                        </div>

                        <div class="mb-3">
                            <label for="txtCep" class="form-label">Cep</label>
                            <input type="text" name="txtCep" id="txtCep"
                                class="form-control"
                                placeholder="Digite o cep..">
                        </div>

                        <div class="mb-3">
                            <label for="txtComplemento" class="form-label">Complemento</label>
                            <input type="text" name="txtComplemento" id="txtComplemento"
                                class="form-control"
                                placeholder="Digite o complemento..">
                        </div>

                        <div class="mb-3">
                            <label for="txtCidade" class="form-label">Cidade</label>
                            <input type="text" name="txtCidade" id="txtCidade"
                                class="form-control"
                                placeholder="Digite a cidade..">
                        </div>

                        <input type="submit" value="Salvar" name="btnSalvar" class="btn btn-success">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>