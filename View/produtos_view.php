<?php 
require __DIR__ . "/../Model/APIcurl.php";
require __DIR__ . "/../Model/Carrinho.php";
require __DIR__ . "/../Model/Produto.php";

session_start();

$apresentacoes = (new APIcurl)->requisicaoProduto();


$apresentacoesUnicas = array();


foreach ($apresentacoes['result'] as $apresentacao) {
    $id = $apresentacao['idapresentacao'];

    if ($apresentacao['dscapresentacao'] !== 'O Amor e Revolução') {
        if ($apresentacao['dscapresentacao'] !== 'Teste Mercado Pago') {
            if (!isset($apresentacoesUnicas[$id])) {
                $apresentacoesUnicas[$id] = array(); 
            }

            $apresentacoesUnicas[$id][] = $apresentacao;
        }
    }
}

//var_dump($apresentacoesUnicas);

if (isset($_GET['idProduto']) && isset($_GET['idApresentacao'])) {
    $idProduto = strip_tags($_GET['idProduto']);
    $idApresentacao = strip_tags($_GET['idApresentacao']);
    
    foreach ($apresentacoesUnicas[$idApresentacao] as $apresentacao) {
        if ($apresentacao['idproduto'] === $idProduto) {

            $produto = new Produto;
            $produto->setId($apresentacao['idproduto']);
            $produto->setDscproduto($apresentacao['dscproduto']);
            $produto->setPreco($apresentacao['preco']);
            $produto->setCidade($apresentacao['dsccidade']);
            $produto->setQuantidade(1);
            $produto->setData($apresentacao['dthr_apresentacao']);
            $produto->setImagem($apresentacao['imagem_pequena']);
            $produto->setDscapresentacao($apresentacao['dscapresentacao']);

            $carrinho = new Carrinho;
            $carrinho->add($produto);

            //break;
        }
    }

    header('Location: http://localhost:8080/View/produtos_view.php');
}


if (isset($_SESSION['carrinho']['produtos'])) {
    
    $quantidade_produtos = 0;

    foreach ($_SESSION['carrinho']['produtos'] as $produto) {
        $quantidade_produtos += $produto->getQuantidade();
    }

} else {
    $quantidade_produtos = 0;
}

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
        
        <a href="login_view.php">
            <img class="image" src="/images/login_sair.png" alt="login sair img">
        </a>

        <a href="carrinho_view.php" class="carrinho-link">
            <img class="image" src="/images/cart.png" alt="cart img" >
            <?php echo '<span class="quantidade-no-carrinho">' . $quantidade_produtos  . '</span>'; ?>
        </a>
    </header>

    <div class="card-container">
        <?php 
            $total_cartoes = 8;
            $cartoes_por_linha = 4;
            $cartoes_exibidos = 0;

            
            foreach ($apresentacoesUnicas as $idapresentacao => $apresentacoes) {
                $apresentacao = $apresentacoes[0]; 

                echo '<div class="card">';
                echo '<img src="' . $apresentacao['imagem_pequena'] . '" alt="Imagem da Apresentação">';
                echo "<h1>" . $apresentacao['dscapresentacao'] . "</h1>";
                echo "<h2><strong>Data:</strong> " . $apresentacao['dthr_apresentacao'] . "</h2>";
                echo "<h2><strong>Cidade:</strong> " . $apresentacao['dsccidade'] . "</h2>";

                echo '<form action="" method="post">';
                echo '<input type="hidden" name="idapresentacao" value="'. $idapresentacao .'">';
                echo '<input type="submit" name="comprar" value="Comprar">';
                echo '</form>';
                

                echo '</div>';

                $cartoes_exibidos++;

                if ($cartoes_exibidos % $cartoes_por_linha === 0 && $cartoes_exibidos != $total_cartoes) {
                    echo '<br>';
                }

                if ($cartoes_exibidos >= $total_cartoes) {
                    break;
                }
            }

            if (isset($_POST["comprar"])) {
                $idapresentacao = $_POST['idapresentacao'];

                echo '<div class="caixa-ingressos">';
                echo '<span class="close-btn" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
                echo '<h2>Detalhes do Ingresso</h2>';
                foreach ($apresentacoesUnicas[$idapresentacao] as $apresentacoes) {
                    $idproduto = $apresentacoes['idproduto'];
                    echo "<p>" . $apresentacoes['dscproduto'] . ": R$" . $apresentacoes['preco'] .  "</p>";
                    echo "<a href='?idProduto=$idproduto&idApresentacao=$idapresentacao'><button>Adicionar</button></a>";
                }
                echo '</div>';
            }
        ?>

        
        
        
        
    </div>
</body>
</html>