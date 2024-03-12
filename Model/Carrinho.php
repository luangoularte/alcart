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

    public function remove(string $idProduto){
        if(isset($_SESSION['carrinho']['produtos'])) {
            foreach ($this->getCarrinho() as $index => $produto) {
                if($produto->getId() === $idProduto){
                    unset($_SESSION['carrinho']['produtos'][$index]);
                    $_SESSION['carrinho']['total'] -= $produto->getPreco() * $produto->getQuantidade();
                }
            } 
        }
    }

    public function getCarrinho(){
        return $_SESSION['carrinho']['produtos'] ?? [];
    }

    public function getTotal() {
        return $_SESSION['carrinho']['total'] ?? 0;
    }


}



?>