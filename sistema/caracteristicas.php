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
    $sql = $pdo->query("SELECT * FROM Caracteristica");
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
                
                    
                    <td><form action="editar_caracteristicas.php" method="POST">
                        <button class="btn btn-primary" name="btnEditar" 
                        value="<?php echo $linha['id'];?>">Editar</button>
                    </form></td>

                    <td><form action="excluir_caracteristicas.php" method="POST"> 
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

                    <form action="adicionar_caracteristicas.php" method="POST">
                        <h3 class="mb-4">Cadastro de Caracteristicas</h3>
                        
                        <div class="mb-3">
                            <label for="txtNome" class="form-label">Nome da Caracteristica</label>
                            <input type="text" name="txtNome" id="txtNome"
                                class="form-control"
                                placeholder="Digite o nome da caracteristica.." required>
                        </div>

                        <div class="mb-3">
                            <label for="txtDescricao" class="form-label">Descrição da Caracteristica</label>
                            <input type="text" name="txtDescricao" id="txtDescricao"
                                class="form-control"
                                placeholder="Digite a descrição da caracteristica.." required>
                        </div>

                        <input type="submit" value="Salvar" name="btnSalvar" class="btn btn-success">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>