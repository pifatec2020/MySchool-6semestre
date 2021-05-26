<?php 
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql = "select * from log where action = 'login'";
$result = mysqli_query($link,$sql);

$i = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include('../include/bootstrap.php');
    ?>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

<a class='a' href="http://localhost/templates/log/log.php"><div class='center'>Login</div></a>
<div class='center2'> <a href='http://localhost/templates/log/pdf/loginpdf.php'><button class='btn btn-danger'>Gerar PDF</button></div></a>
    <div class='info'>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Description</th>
                    <th scope="col">User</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while($qr = mysqli_fetch_assoc($result)){ 
                $action = $qr['action']; 
                $ds = $qr['description'];   
                $user = $qr['usuario'];
                $time = $qr['tempo'];
                ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$action?></td>
                    <td><?=$ds?></td>
                    <td><?=$user?></td>
                    <td><?=date('d/m/Y H:i:s', strtotime($time))?></td>
                </tr>  <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</body>

</html>