<?php
require 'conexao.php';

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone');
    $senha = $_POST['senha'];

    if($nome && $email && $senha) {
        // Criptografia da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Cliente (nome, email, telefone, senha_hash) VALUES (:nome, :email, :tel, :senha)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':tel', $telefone);
        $stmt->bindValue(':senha', $senha_hash);

        try {
            $stmt->execute();
            $sucesso = "Cliente cadastrado com sucesso!";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $erro = "Este e-mail já está cadastrado no sistema.";
            } else {
                $erro = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Loja Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px 0; /* Espaço para não colar nas bordas em mobile */
        }
        .card-cadastro {
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="card card-cadastro shadow">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Criar Nova Conta</h3>

            <?php if(!empty($sucesso)): ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $sucesso; ?> <br>
                    <a href="login.php" class="alert-link">Clique aqui para fazer Login</a>
                </div>
            <?php endif; ?>

            <?php if(!empty($erro)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <?php if(empty($sucesso)): ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Endereço de Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone (Opcional)</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                    <div class="form-text">Nunca compartilharemos sua senha com ninguém.</div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
                </div>
            </form>
            <?php endif; ?>

            <div class="text-center mt-3">
                <small class="text-muted">Já tem uma conta?</small> 
                <a href="login.php" class="text-decoration-none fw-bold">Fazer Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>