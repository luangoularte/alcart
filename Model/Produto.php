<?php 

class Produto{

    private string $id;
    private string $dscproduto; // inteira, meiaa
    private string $preco;
    private string $cidade;
    private int $quantidade;
    private string $data;

    public function setId(string $id) {
        $this->id = $id;
    }

    public function setDscproduto(string $dscproduto) {
        $this->dscproduto = $dscproduto;
    }
    
    public function setPreco(string $preco) {
        $this->preco = $preco;
    }

    public function setCidade(string $cidade) {
        $this->cidade = $cidade;
    }

    public function setQuantidade(int $quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getId() {
        return $this->id;
    }

    public function getDscproduto() {
        return $this->dscproduto;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getData() {
        return $this->data;
    }




}



?>