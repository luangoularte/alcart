<?php 

require __DIR__ . "/../Controller/produtos_controller.php";

$apresentacoesUnicas = apresentacoesPorId();
$carrinho = new Carrinho;

adicionarProdutoCarrinho($apresentacoesUnicas, $carrinho);
redirecionarLogin();
sair();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="/images/ALico.ico" type="image/x-icon">
    <link rel="stylesheet" href="produto.css">
    <title>Produtos</title>
</head>
    
<body>
    
    <header>
        <a href="produtos_view.php">
            <img src="/images/ALlogo(3).png" alt="logo ALcart">
        </a>
        
        <a href="?sair=true">
            <img class="image" src="/images/login_sair.png" alt="login sair img">
        </a>

        <a href="carrinho_view.php" class="carrinho-link">
            <img class="image" src="/images/cart.png" alt="cart img" >
            <?php echo '<span class="quantidade-no-carrinho">' . calcularQuantidade()  . '</span>'; ?>
        </a>
    </header>

    <div class="card-container">
        <?php 
            exibirApresentacoes($apresentacoesUnicas);
            exibirIngressos($apresentacoesUnicas);
        ?>       
    </div>
</body>
</html>