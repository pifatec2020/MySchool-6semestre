<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$idpd = $_GET['id'];
$idd = $_GET['idd'];
$id = $_SESSION['id'];
$sql = "select * from aula where id_pd = $idpd";
$sqld = "select * from disciplina where id = $idd";
$resultd = mysqli_query($link,$sqld);
$qrd = mysqli_fetch_assoc($resultd);
$nomed = $qrd['nome'];
$result = mysqli_query($link, $sql);
$_SESSION['nomed'] = $nomed;
$msg = false;

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


    </style>
</head>

<body>
    <?php include('../include/navbar2.php')  ?>
    <div class="col-md-12">
        <div class="container">
            <?php 
            include('./include/recado.php');
            include('./include/menu-a.php');
            ?>

            


            <div class="conteudo">

            <h4>Aulas da disciplina:  <span style='color: brown'><?=$nomed?></span></h4>
            <div class='aula'>
              <?php 
               while($qr = mysqli_fetch_assoc($result)){
                   $id_turma = $qr['id_turma'];
                   $id_aula = $qr['id'];
                   $quantidade = $qr['quantidade'];
                   $data = $qr['data'];

                   $sql_aa = "select * from aula_aluno where id_aula = $id_aula";
                   $result_aa = mysqli_query($link,$sql_aa);
                   $qr_aa = mysqli_fetch_assoc($result_aa);
                   if($qr_aa){
                       $msg = true;
                   }else {
                       $msg = false;
                   }

                   ?>
                   <form action='aula.php' method='GET'><?php 
                   echo "
                   <input class='d-none' value='".$id_aula."' name='id_aula'>
                   <input class='d-none' value='".$id_turma."' name='id_turma'>
                   <input class='d-none' value='".$quantidade."' name='quantidade'>
                   <div>".date('d/m/Y', strtotime($data))."</div>"; ?>
                   <button class='btn btn-outline-dark'<?php if($msg){echo "disabled";}else{echo '';} ?> >Cadastrar presença</button>
                   </form>

                   <div> _____________________________________________ </div> <?php
               } ?>
            
            </div>
           
            </div>
        </div>

    </div>
</body>

</html>