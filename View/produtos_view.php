<?php 
require __DIR__ . "/../Model/APIcurl.php";

$apresentacoes = (new APIcurl)->requisicaoProduto();

//var_dump($apresentacoes);

$apresentacoesUnicas = array();

foreach ($apresentacoes['result'] as $apresentacao) {
    $id = $apresentacao['idapresentacao'];
    if (!isset($apresentacoesUnicas[$id])) {
        $apresentacoesUnicas[$id] = array(); 
    }

    $apresentacoesUnicas[$id][] = $apresentacao;
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produto.css">
    <title>Produtos</title>
</head>
<body>
    <div class="card-container">
        <?php 
            $total_cartoes = 8;
            $cartoes_por_linha = 4;
            $cartoes_exibidos = 0;
        
            foreach ($apresentacoesUnicas as $idapresentacao => $apresentacoes) {
                $apresentacao = $apresentacoes[0]; 

                echo '<div class="card">';
                echo '<img src="' . $apresentacao['imagem_pequena'] . '" alt="Imagem da Apresentação">';
                echo "<h1><strong>Nome:</strong> " . $apresentacao['dscapresentacao'] . "<h1>";
                echo "<h2><strong>Data:</strong> " . $apresentacao['dthr_apresentacao'] . "</h2>";
                echo "<h2><strong>Cidade:</strong> " . $apresentacao['dsccidade'] . "</h2>";
                echo "<p><button>Comprar</button></p>";
                echo '</div>';

                $cartoes_exibidos++;

                if ($cartoes_exibidos % $cartoes_por_linha === 0 && $cartoes_exibidos != $total_cartoes) {
                    echo '<br>';
                }

                if ($cartoes_exibidos >= $total_cartoes) {
                    break;
                }
            }
        ?>
    </div>
    
    
</body>
</html>