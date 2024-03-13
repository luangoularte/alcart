<?php session_start();?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="/images/ALico.ico" type="image/x-icon">
        <title>Login</title>
    </head>
    <body>
        <section>
            <div class="container">
                <div class="f">
                </div>
                
                <div class="barra-login">

                    <div class="formulario-login">
                        <img src="/images/ALlogo(3).png" alt="allogo" class="logo"></img>
            
                        <form class="form-login_view" action="../Controller/login_controller.php" method="post">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" required>
                            <label for="cpf">CPF</label>
                            <input type="number" name="cpf" id="cpf" required style="-moz-appearance: textfield; -webkit-appearance: textfield;" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            <div class='button-login'>
                                <button type="submit" value="Login"><strong>Entrar</strong></button>
                            </div>
                            
                        </form>

                        <?php 
                            if (isset($_GET['falha_login'])){
                                echo "<p class='alert-error'>Falha ao realizar Login</p>";
                                unset($_GET['falha_login']);
                            }


                        ?>

                    </div>
                </div>
            </div>  
        </section>
    </body>
</html>