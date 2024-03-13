<?php 

require_once __DIR__ . "/../Model/Produto.php";
require_once __DIR__ . "/../Model/Carrinho.php";

session_start();

$carrinho = new Carrinho;
$carrinhoItens = $carrinho->getCarrinho();


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

if (isset($_GET['limparCarrinho'])) {
    $carrinho->removerProdutos();
    header('Location: carrinho_view.php');
}

function exibirCarrinho() {
    global $carrinho;
    
    if (empty($carrinhoItens)) {
        echo '<h1>Carrinho vazio</h1>';
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
        echo "<p><a href='?limparCarrinho=true'><button>Remover Produtos</button></a></p>";
        echo "<button>Checkout</button></p>";
    }
    echo "<p><a href='produtos_view.php'><button>Voltar</button></a></p>";
}