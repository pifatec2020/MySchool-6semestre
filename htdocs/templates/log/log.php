<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
     include('../include/bootstrap.php');
    ?>
</head>
<body>
<div class="container">
    <div class='center display-3'>
         <!-- Myschool System Log -->
    </div>
    <div class='info'>
        <div class="">
            <a href="http://localhost/templates/log/create.php" class='a'><div class=" box">Create</div></a>
            <a href="http://localhost/templates/log/edit.php" class='a'><div class=" box ">Edit</div></a>
            <a href="http://localhost/templates/log/add.php" class='a'><div class=" box">Add</div></a>
            <a href="http://localhost/templates/log/delete.php" class='a'><div class=" box">Delete</div></a>
            <a href="http://localhost/templates/log/login.php" class='a'><div class=" box">Login</div></a>
            <a href="http://localhost/templates/log/logout.php" class='a'><div class=" box">Logout</div></a>
            <a href="http://localhost/templates/log/mainlog.php" class='a'><div class=" box2 bg-warning">MAIN LOG</div></a>
            <a href="http://localhost/script/sair.php" class='a'><div class=" box2 bg-danger">Exit</div></a>
        </div>
    </div>
    </div>
</body>
</html>