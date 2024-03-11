<?php 


class Carrinho {

    public function add(Produto $produto){
        $NoCarrinho = false;
        $this->setTotal($produto);
        if (count($this->getCarrinho()) > 0) {
            foreach ($this->getCarrinho() as $produtoNoCarrinho) {
                if ($produtoNoCarrinho->getId() === $produto->getId()){
                    $quantidade = $produtoNoCarrinho->getQuantidade() + $produto->getQuantidade();
                    $produtoNoCarrinho->setQuantidade($quantidade);
                    $NoCarrinho = true;
                    break;
                }
            }
        }

        if (!$NoCarrinho) {
            $this->setProdutosNoCarrinho($produto);
        }
    }

    private function setProdutosNoCarrinho($produto) {
        $_SESSION['carrinho']['produtos'][] = $produto;
    }

    private function setTotal(Produto $produto) {
        $_SESSION['carrinho']['total'] += $produto->getPreco() * $produto->getQuantidade();
    }

    public function remove(){

    }

    public function getCarrinho(){
        return $_SESSION['carrinho']['produtos'] ?? [];
    }


}



?>