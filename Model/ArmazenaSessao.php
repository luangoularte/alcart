<?php 


class ArmazenaSessao {


    public function armazenaSessao($session_id, $email, $cpf, $entrada_sessao, $saida_sessao, $carrinho, $total, $connect) {
        try {
            $stmt = $connect->prepare("INSERT INTO sessions (session_id, email, cpf, entrada_sessao, saida_sessao, carrinho, total) VALUES (:session_id, :email, :cpf, :entrada_sessao, :saida_sessao, :carrinho, :total)");
    
            $stmt->bindParam(':session_id', $session_id);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':entrada_sessao', $entrada_sessao);
            $stmt->bindParam(':saida_sessao', $saida_sessao);
            $stmt->bindParam(':carrinho', $carrinho);
            $stmt->bindParam(':total', $total);
    
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao armazenar sessão: " . $e->getMessage());
        }
    }
}

?>