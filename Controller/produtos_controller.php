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



if (isset($_GET['idProduto']) && isset($_GET['idApresentacao']) && isset($_GET['quantidade'])) {
    $idProduto = strip_tags($_GET['idProduto']);
    $idApresentacao = strip_tags($_GET['idApresentacao']);
    $quantidade = strip_tags($_GET['quantidade']);
    
    foreach ($apresentacoesUnicas[$idApresentacao] as $apresentacao) {
        if ($apresentacao['idproduto'] === $idProduto) {

            $produto = new Produto;
            $produto->setId($apresentacao['idproduto']);
            $produto->setDscproduto($apresentacao['dscproduto']);
            $produto->setPreco($apresentacao['preco']);
            $produto->setCidade($apresentacao['dsccidade']);
            $produto->setQuantidade($quantidade);
            $produto->setData($apresentacao['dthr_apresentacao']);
            $produto->setImagem($apresentacao['imagem_grande']);
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

function exibirApresentacoes() {
    global $apresentacoesUnicas;
    $total_cartoes = 8;
    $cartoes_por_linha = 4;
    $cartoes_exibidos = 0;

    foreach ($apresentacoesUnicas as $idapresentacao => $apresentacoes) {
        $apresentacao = $apresentacoes[0]; 

        echo '<div class="card">';
        echo '<img src="' . $apresentacao['imagem_grande'] . '" alt="Imagem da Apresentação">';
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
}

function exibirIngressos() {
    global $apresentacoesUnicas;

    if (isset($_POST["comprar"])) {
        $idapresentacao = $_POST['idapresentacao'];

        echo '<div class="caixa-ingressos">';
        echo '<span class="close-btn" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
        echo '<h2>Detalhes do Ingresso</h2>';
        foreach ($apresentacoesUnicas[$idapresentacao] as $apresentacoes) {
            $idproduto = $apresentacoes['idproduto'];
            echo "<p>" . $apresentacoes['dscproduto'] . ": <strong>R$" . $apresentacoes['preco'] .  "</strong></p>";
            
            echo "<form method='get' action=''>";
            echo "<input type='hidden' name='idProduto' value='$idproduto'>";
            echo "<input type='hidden' name='idApresentacao' value='$idapresentacao'>";
            echo "<label for='quantidade'>Quantidade:</label>";
            echo "<select name='quantidade' id='quantidade'>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            echo "<button type='submit'>Adicionar</button>";
            echo "</form>";
        }
        echo '</div>';
    }
}
