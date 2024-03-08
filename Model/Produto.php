<?php 

class Produto{

    private int $id;
    private string $dscproduto; // inteira, meiaa
    private float $preco;
    private string $cidade;
    private int $quantidade;
    private $data;

    public function setId($id) {
        $this->id = $id;
    }

    public function setDscproduto($dscproduto) {
        $this->dscproduto = $dscproduto;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setQuantidade($quantidade) {
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

    public function getData() {
        return $this->data;
    }




}



?>