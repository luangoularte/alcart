<?php 

require __DIR__ . "/../Model/APIcurl.php";

session_start();

function realizarLogin() {
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $result = (new APIcurl)->requisicaoLogin($email, $cpf);

    return $result;
}

function iniciarSessao($email, $cpf) {
    date_default_timezone_set('America/Sao_Paulo');
    $cpfCriptografado = password_hash($cpf, PASSWORD_DEFAULT);
    $_SESSION['email'] = $email;
    $_SESSION['cpf'] = $cpfCriptografado;
    $_SESSION['entrada_sessao'] = date("H:i:s");
}

if (!empty($_POST['email']) && !empty($_POST['cpf'])){

    $result = realizarLogin();

    if (!empty($result['result'])) {
        iniciarSessao($_POST['email'], $_POST['cpf']);
        header('Location: ../View/produtos_view.php');

    } else {
        header('Location: ../View/login_view.php?falha_login=true');

    }
}
