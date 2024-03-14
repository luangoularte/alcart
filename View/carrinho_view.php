<?php 

require __DIR__ . "/../Controller/carrinho_controller.php";



redirecionarLogin();
sair();
calcularQuantidadeCarrinho();
removerProduto();
limparCarrinho();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="carrinho.css">
    <link rel="icon" href="/images/ALico.ico" type="image/x-icon">
    <title>Carrinho</title>
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
            <?php echo '<span class="quantidade-no-carrinho">' . $quantidade_produtos  . '</span>'; ?>
        </a>
    </header>
    

    <div class="carrinho">
        
        <?php 
            exibirCarrinho();
        ?>
    </div>
</body>
</html>