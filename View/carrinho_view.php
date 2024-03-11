<?php 


require_once __DIR__ . "/../Model/Produto.php";
session_start();




?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="carrinho.css"> -->
    <title>Carrinho</title>
</head>
<body>

    <div class='session'><?php var_dump($_SESSION['carrinho']['produtos'] ?? []); ?></div>

    <div class="carrinho">
        
        <?php 
            if (empty($_SESSION['carrinho']['produtos'])) {
                echo 'Carrinho vazio';
            }

            foreach ($_SESSION['carrinho']['produtos'] as $produto) {
                echo '<div class="produto">';
                echo '<div class="imagem">';
                echo '<img src=" ' . $produto->getImagem() .'" alt="Imagem da Apresentação">';
                echo '</div>';
                echo '<div class="informacoes">';
                echo "<p>" . $produto->getDscapresentacao() . "</p>";
                echo"<p>" . $produto->getCidade() . "</p>";
                echo "<p>" . $produto->getPreco() . "</p>";
                echo "<p>" . $produto->getDscproduto() . "</p>";
                echo "<p>" . $produto->getQuantidade() . "</p>";
               
                
                
                
                
                echo '</div>';
            }
            

        ?>
    </div>
</body>
</html>