<?php 


require_once __DIR__ . "/../Model/Produto.php";
require_once __DIR__ . "/../Model/Carrinho.php";

session_start();

$carrinho = new Carrinho;
$carrinhoItens = $carrinho->getCarrinho();

var_dump($carrinhoItens);

if (isset($carrinhoItens)) {
    
    $quantidade_produtos = 0;

    foreach ($carrinhoItens as $produto) {
        $quantidade_produtos += $produto->getQuantidade();
    }

} else {
    $quantidade_produtos = 0;
}

if (isset($_GET['idProduto'])) {
    $idProduto = strip_tags($_GET['idProduto']);
    $carrinho->remove($idProduto);
    header('Location: carrinho_view.php');
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="carrinho.css">
    <title>Carrinho</title>
</head>
<body>
    <header>
        <a href="produtos_view.php">
            <img src="/images/ALlogo(3).png" alt="logo ALcart">
        </a>
        
        <a href="login_view.php">
            <img class="image" src="/images/login_sair.png" alt="login sair img">
        </a>
        
        <a href="login_view.php">
            <img class="image" src="/images/login.png" alt="login img">
        </a>

        <a href="carrinho_view.php" class="carrinho-link">
            <img class="image" src="/images/cart.png" alt="cart img" >
            <?php echo '<span class="quantidade-no-carrinho">' . $quantidade_produtos  . '</span>'; ?>
        </a>
    </header>
    

    <div class="carrinho">
        
        <?php 
            if (empty($carrinhoItens)) {
                echo '<h1>Carrinho vazio</h1>';
                echo "<a href='produtos_view.php'>Voltar</a>";
            } else {
                foreach ($carrinhoItens as $produto) {
                    echo '<div class="produto">';
                    echo '<div class="imagem">';
                    echo '<img src=" ' . $produto->getImagem() .'" alt="Imagem da Apresentação">';
                    echo '</div>';
                    echo '<div class="informacoes">';
                    echo "<p>" . $produto->getDscapresentacao() . "</p>";
                    echo"<p>" . $produto->getCidade() . "</p>";
                    echo "<p>" . $produto->getDscproduto() . "</p>";
                    echo "<p>Quantidade: " . $produto->getQuantidade() . "</p>";
                    echo "<p>Preço: R$" . $produto->getPreco() . "</p>";
                    echo "<p>Subtotal: R$" . number_format($produto->getPreco() * $produto->getQuantidade(), 2, ',', '.') . "</p>";
                    echo "<a href='?idProduto=" . $produto->getId() . "'>Remover</a>";
                    echo '</div>';
                }
            
                echo "<p>Total: R$" . number_format($carrinho->getTotal(), 2, ',', '.') . "</p>";
                echo "<button>Checkout</button>";
            }
        ?>
    </div>
</body>
</html>