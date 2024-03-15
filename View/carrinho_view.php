<?php 

require __DIR__ . "/../Controller/carrinho_controller.php";

redirecionarLogin();
sair();
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
    <link rel="icon" href="/Images/ALico.ico" type="image/x-icon">
    <title>Carrinho</title>
</head>
<body>
    
    <header>
        <a href="produtos_view.php">
            <img src="/Images/ALlogo(3).png" alt="logo ALcart">
        </a>
        
        <a href="?sair=true">
            <img class="image" src="/Images/login_sair.png" alt="login sair img">
        </a>

        <a href="carrinho_view.php" class="carrinho-link">
            <img class="image" src="/Images/cart.png" alt="cart img" >
            <?php echo '<span class="quantidade-no-carrinho">' . calcularQuantidadeCarrinho() . '</span>'; ?>
        </a>
    </header>
    
    <div class="carrinho">
        
        <?php 
            exibirCarrinho();
        ?>
        
    </div>
</body>
</html>