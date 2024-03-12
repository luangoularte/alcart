<?php 





?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
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
            
                        <form class="form-login_view" action="../Controller/login.php" method="post">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" required>
                            <label for="cpf">CPF</label>
                            <input type="number" name="cpf" id="cpf" required>
                            <button type="submit" value="Login">Entrar</button>
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