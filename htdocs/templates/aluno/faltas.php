<?php
session_start();

$id_aluno = $_SESSION['id_aluno'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$cpf = $_SESSION['cpf'];
$turma = $_GET['turma'];

$sql = "select * from ds where id_turma = $turma";
$result = mysqli_query($link,$sql);

$soma = 0;
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
     <h6 class='display-5'>Presença</h6>     
    
 </div>
   <div >
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
        $nome_d = $qr_d['nome'];

        $sql_aula = "select * from aula where id_turma = $turma AND id_pd = $idpd";
        $result_aula = mysqli_query($link,$sql_aula);
        while($qr_aula = mysqli_fetch_assoc($result_aula)){
        $id_aula = $qr_aula['id'];

        $sql_falta = "select * from aula_aluno where id_aula = $id_aula AND id_aluno = $id_aluno";
        $result_falta = mysqli_query($link,$sql_falta);
        while($qr_falta = mysqli_fetch_assoc($result_falta)){

            $soma += $qr_falta['frequencia'];
            
        }}
        $num = $soma;
        $soma = 0;
        ?>
        <div class='mt-3 falta-bd'>
        <table class='table table-hover'>
            <tr>
                <td><?=$nome_d?>
                  <input  style="float: right; width: 50px;" type="" value='<?=$num?>' disabled>
                </td>
                
            </tr>
        </table>
        </div>

     <?php } ?>
    
    
   </div>
</body>
</html>