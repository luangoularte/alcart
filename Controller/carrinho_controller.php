<?php 

require_once __DIR__ . "/../Model/Produto.php";
require_once __DIR__ . "/../Model/Carrinho.php";

session_start();

$connect = new Connect();
$connect = $connect->getConnection();

$carrinho = new Carrinho;
$carrinhoItens = $carrinho->getCarrinho();

if (!isset($_SESSION['email']) || !isset($_SESSION['cpf'])) {
    header('Location: login_view.php');
}

if (isset($_GET['sair'])) {
    $session_id = session_id();
    date_default_timezone_set('America/Sao_Paulo');
    $_SESSION['saida_sessao'] = date("H:i:s");
    $salvar = (new ArmazenaSessao)->armazenaSessao($session_id, $_SESSION['email'], $_SESSION['cpf'], 
                                                $_SESSION['entrada_sessao'], $_SESSION['saida_sessao'], 
                                                $_SESSION['carrinho'],$_SESSION['total'], $connect);
    session_unset();
    header('Location: login_view.php');
}

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
    global $carrinhoItens;
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
                    echo "<p>Preço: R$" . number_format($produto->getPreco(), 2, ',', '.') . "</p>";
                    echo "<p>Subtotal: R$" . number_format($produto->getPreco() * $produto->getQuantidade(), 2, ',', '.') . "</p>";
                    echo "<a href='?idProduto=" . $produto->getId() . "'><button>Remover</button></a>";
                echo '</div>';
            echo '</div>';
            echo "<br>";
        }
        echo '<div class="total">';
            echo "<p class='esquerda'>Total: R$" . number_format($carrinho->getTotal(), 2, ',', '.') . "</p>";
            echo '<div class="direita">';
                echo "<p><a href='?limparCarrinho=true'><button>Remover Produtos</button></a></p>";
                echo "<p><button>Checkout</button></p>";
             echo '</div>';
        echo '</div>';

    }
    echo "<p><a href='produtos_view.php'><button>Voltar</button></a></p>";
}