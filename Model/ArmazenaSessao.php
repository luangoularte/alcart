<?php 

class ArmazenaSessao {

    public function armazenaSessao($email, $cpf, $entrada_sessao, $saida_sessao, $carrinho, $total, $connect) {
        try {

            $carrinho_serializado = serialize($carrinho);

            $stmt = $connect->prepare("INSERT INTO sessions (email, cpf, entrada_sessao, saida_sessao, carrinho, total) VALUES (:email, :cpf, :entrada_sessao, :saida_sessao, :carrinho, :total)");
    
            
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':entrada_sessao', $entrada_sessao);
            $stmt->bindParam(':saida_sessao', $saida_sessao);
            $stmt->bindParam(':carrinho', $carrinho_serializado);
            $stmt->bindParam(':total', $total);
    
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao armazenar sessão: " . $e->getMessage());
        }
    }
}

?>