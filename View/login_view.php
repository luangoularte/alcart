

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
        <form class="form-login_view" action="../Controller/login.php" method="post">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
            <label for="cpf">CPF</label>
            <input type="number" name="cpf" id="cpf" required>
            <input type="submit" value="Login">
        </form>

        <?php 
            if (isset($_GET['falha_login'])){
                echo '<p>Falha ao realizar Login</p>';
            }
        ?>
    </section>
</body>
</html>