<?php
session_start();


require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$cpf = $_SESSION['cpf'];

$sql = "select * from upload_img where id_user = $cpf";
$result = mysqli_query($link,$sql);
$qr = mysqli_fetch_assoc($result);
$img = $qr['arquivo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="stylesheet" href="./estilo/style.css">
    <?php
    include('../include/w3school.php');
    include('../include/bootstrap.php');
    ?>
</head>
<body class="">
  <?php include('../include/navbar3.php'); ?>
  <div class="ml-2">
        <div class="row justify-content">
            <?php include('./include/painel.php'); ?>
            
    </div>
</body>
</html>