<?php 

require_once __DIR__ . "/../Model/Produto.php";
require_once __DIR__ . "/../Model/Carrinho.php";

session_start();

$carrinho = new Carrinho;
$carrinhoItens = $carrinho->getCarrinho();

function redirecionarLogin() {
    if (!isset($_SESSION['email']) || !isset($_SESSION['cpf'])) {
    header('Location: login_view.php');
    }
}


function sair(){
    global $connect;
    
    if (isset($_GET['sair'])) {
        date_default_timezone_set('America/Sao_Paulo');
        $_SESSION['saida_sessao'] = date("H:i:s");
        session_unset();
        header('Location: login_view.php');
    }
}

function calcularQuantidadeCarrinho(){
    global $carrinhoItens;

    if (isset($carrinhoItens)) {
        
        $quantidade_produtos = 0;

        foreach ($carrinhoItens as $produto) {
            $quantidade_produtos += $produto->getQuantidade();
        }

    } else {
        $quantidade_produtos = 0;
    }    

    return $quantidade_produtos;
}


function removerProduto() {
    global $carrinho;

    if (isset($_GET['idProduto'])) {
        $idProduto = strip_tags($_GET['idProduto']);
        $carrinho->remove($idProduto);
        header('Location: carrinho_view.php');
    }    
}

function limparCarrinho() {
    global $carrinho;

    if (isset($_GET['limparCarrinho'])) {
        $carrinho->removerProdutos();
        header('Location: carrinho_view.php');
    }    
}


function exibirCarrinho() {
    global $carrinhoItens;
    global $carrinho;
    
    if (empty($carrinhoItens)) {
        echo '<div class="vazio">';
            echo '<h1>Carrinho vazio!</h1>';
        echo '</div>';
        echo "<p class='btn-home'><a href='produtos_view.php'><button>Voltar</button></a></p>";
    } else {
        foreach ($carrinhoItens as $produto) {
            echo '<div class="produto">';
                echo '<div class="imagem">';
                    echo '<img src=" ' . $produto->getImagem() .'" alt="Imagem da Apresentação">';
                echo '</div>';
                echo '<div class="informacoes">';
                    echo '<div class="info-esquerda">';
                        echo "<h1>" . $produto->getDscapresentacao() . "</h1>";
                        echo"<p>Cidade: " . $produto->getCidade() . "</p>";
                        echo "<p>Tipo: " . $produto->getDscproduto() . "</p>";
                    echo '</div>';
                    echo '<div class="info-direita">';
                        echo "<p>Quantidade: " . $produto->getQuantidade() . "</p>";
                        echo "<p>Preço: R$" . number_format($produto->getPreco(), 2, ',', '.') . "</p>";
                        echo "<p>Subtotal: R$" . number_format($produto->getPreco() * $produto->getQuantidade(), 2, ',', '.') . "</p>";
                        echo '<div class="but-direita">';
                            echo "<a href='?idProduto=" . $produto->getId() . "'><button>Remover</button></a>";
                        echo "</div>";
                    echo "</div>";
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
        echo "<p class='btn-home'><a href='produtos_view.php'><button>Continuar comprando</button></a></p>";

    }
}
