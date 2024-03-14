<?php 

class APIcurl {

    public function requisicaoLogin($email, $cpf){

        $dados = [
            "email" => $email,
            "cpf"   => $cpf
        ];


        $url = "https://ah.we.imply.com/al/login";

        $curl = curl_init($url);

        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => false, 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_POST => true, 
            CURLOPT_POSTFIELDS => json_encode($dados))
        );


        $response = curl_exec($curl);

        curl_close($curl);

        $decoded = json_decode($response, true);
        
        return $decoded;
    }

    public function requisicaoProduto(){

        $url = "https://ah.we.imply.com/al/produto";

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//erro com o SSL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        $decoded = json_decode($response, true);

        curl_close($curl);

        return $decoded;
    }
}

//$teste = (new APIcurl)->requisicaoProduto();
//var_dump($teste);

?>

