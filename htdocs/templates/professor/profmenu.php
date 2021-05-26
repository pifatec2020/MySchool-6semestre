<?php 
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo/style.css" />
    <?php
    include('../include/w3school.php');
    include('../include/bootstrap.php');
    ?>
    
    <title>Document</title>
    <style>
        /* body {

            background: -webkit-gradient(linear, left top, left bottom, from(rgb(128, 102, 270)), to(rgb(255, 150, 200))) fixed;    

        } */
        
    </style>
</head>

<body>
    <?php include('../include/navbar2.php')  ?>
    <div class="centro">
        <div>
            <a href="http://localhost/templates/professor/dashboard.php"><img class='img-prof' src="../adm/query/uploads/<?php echo $img ?>" alt=""></a>  
            <p class="font-prof">Bem vindo Professor(a) <?= $_SESSION['nome']; ?>.</p>
        </div>
    </div>
</body>

</html>