<?php 
$err = isset($_GET['error']) ? $_GET['error']: 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./templates/include/bootstrap.php') ?>
    <link rel="stylesheet" href="./templates/css/index..css">
    <title>Document</title>
</head>

<body>
    <div class="centro">
    <h2 class="display-1 logo">MySchool</h2>
            <form action="./dbQuery/validarAcesso.php" method="POST">
                <input name="user" class="input" type="text" placeholder="Usuário" required>
                <input name="password" class="input" type="password" placeholder="Senha" required >
                <br/>
                <?php if($err == 1){
                    ?> <div class='text-danger'>Usuário não encontrado</div> <?php
                } ?>
                <button class="botao">Entrar</button>
            </form>
    </div>
</body>

</html>