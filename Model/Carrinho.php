<?php 


class Carrinho {

    public function add(Produto $produto){
        $NoCarrinho = false;
        if (count($this->getCarrinho()['produtos']) > 0) {
            foreach ($this->getCarrinho()['produtos'] as $produtoNoCarrinho) {
                if ($produtoNoCarrinho->getId() === $produto->getId()){
                    $quantidade = $produtoNoCarrinho->getQuantity() + $produto->getQuantidade();
                    $produtoNoCarrinho->setQuantidade($quantidade);
                    $NoCarrinho = true;
                    break;
                }
            }
        }
    }
    public function remove(){

    }

    public function getCarrinho(){
        return $_SESSION['carrinho'] ?? [];
    }


}



?>