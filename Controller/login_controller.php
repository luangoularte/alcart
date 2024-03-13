<?php 

require __DIR__ . "/../Model/APIcurl.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['cpf'])){

        $email = $_POST['email'];
        $cpf = $_POST['cpf'];

        $result = (new APIcurl)->requisicaoLogin($email, $cpf);

        if (!empty($result['result'])) {
            header('Location: ../View/produtos_view.php');
            exit;
        } else {
            header('Location: ../View/login_view.php?falha_login=true');
            exit;
        }
    }

}