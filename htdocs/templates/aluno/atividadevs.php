<?php
session_start();

$msg = false;
$id_aluno = $_SESSION['id_aluno'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$turma = $_GET['turma'];
$idpd = $_GET['pd'];

$sql = "select * from atividade where id_turma = $turma AND id_professor_disciplina = $idpd";
$result = mysqli_query($link, $sql);

$sql_pd = "select * from professor_disciplina where id = $idpd";
$result_pd = mysqli_query($link,$sql_pd);
$qrpd = mysqli_fetch_assoc($result_pd);
$idd = $qrpd['id_disciplina'];
$sql_d = "select * from disciplina where id = $idd";
$result_d = mysqli_query($link,$sql_d);
$qrd = mysqli_fetch_assoc($result_d);
$nome_d = $qrd['nome'];
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
    <h4 class='display-6 middle3'>Atividades da disciplina: <span><?=$nome_d?>  </span></h4>
    
        <?php
        while ($qr = mysqli_fetch_assoc($result)) {
            $titulo = $qr['titulo'];
            $id_atividade = $qr['id'];
            $descricao = $qr['descricao'];
            $data = $qr['data_entrega'];

            echo "
            <div class=' middle box'>
               <div class='titulo'>".$titulo."</div>
               <div class='descricao'>".$descricao."</div>
               <div class='data'>Data de entrega: ".date('d/m/Y', strtotime($data))."</div> 
            </div>
            ";
        } 
        ?>
        
    </div>
</body>

</html>