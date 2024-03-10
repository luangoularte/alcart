<?php 


class Carrinho {

    public function add(Produto $produto){
        $NoCarrinho = false;
        $this->setTotal($produto);
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

        if (!$NoCarrinho) {
            $this->setProdutosNoCarrinho($produto);
        }
    }

    private function setProdutosNoCarrinho($produto) {
        $this->getCarrinho()['produtos'][] = $produto;
    }

    private function setTotal(Produto $produto) {
        $this->getCarrinho()['total'] += $produto->getPreco() * $produto->getQuantidade();
    }

    public function remove(){

    }

    public function getCarrinho(){
        return $_SESSION['carrinho'] ?? [];
    }


}



?>