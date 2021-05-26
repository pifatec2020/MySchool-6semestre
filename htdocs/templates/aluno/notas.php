<?php
session_start();

$id_aluno = $_SESSION['id_aluno'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$turma = $_GET['turma'];

$sql = "select * from ds where id_turma = $turma";
$result = mysqli_query($link,$sql);
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
 <div class='container1'>
     <h6 class='display-5'>Selecione uma disciplina</h6>     
    
 </div>
   <div class='middle'>
   <?php 
    while($qr = mysqli_fetch_assoc($result)){
        $idpd = $qr['id_pd'];
        $sql_pd = "select * from professor_disciplina where id = $idpd";
        $result_pd = mysqli_query($link,$sql_pd);

        $qr_pd = mysqli_fetch_assoc($result_pd);
        $idd = $qr_pd['id_disciplina'];
        $sql_d = "select * from disciplina where id = $idd";
        $result_d = mysqli_query($link,$sql_d);

        $qr_d = mysqli_fetch_assoc($result_d);
        $nome = $qr_d['nome'];

        echo "<a class='href' href='notatividade.php?pd=".$idpd."&turma=".$turma."'><div class='div-sao'>".$nome."</div></a>";
    }
   ?>
    
   </div>
</body>
</html>