<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];

$msg = false;

$sql = "select * from aluno_turma where id_turma = $turma";
$result = mysqli_query($link,$sql);
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
            include('./include/menu-at.php');
            ?>

            <div class="conteudo">
            <?php 
            while($qr = mysqli_fetch_assoc($result)){
                $id_aluno = $qr['id_aluno'];
                $sql_aluno = "select * from aluno where id = $id_aluno";
                $result_a = mysqli_query($link,$sql_aluno);
                $qr_aluno = mysqli_fetch_assoc($result_a);
                $nome = $qr_aluno['nome'];
                echo "<div class='col-md-5'> <form class='' action='./query/alunoNota.php' method='POST'>
                         <table class='table table-borderless table-hover table-sm table-striped'>
                         <tr> <td><span style='font-size: 18px;'>".$nome."</span></td> <td><input name='nota' class='form-control' style='float: right; width: 70px;' type='number' min='1' max='10.0' > </td>
                        
                         </tr>
                         </table>
                         <input value='".$id_aluno."' name='id_aluno' class='d-none'>
                         <input value='".$atividade."' name='atividade' class='d-none'>
                         <input value='".$turma."' name='turma' class='d-none'> "; ?>

                         <?php
                         $sql_atv = "select * from aluno_nota where id_aluno = $id_aluno AND id_atividade = $atividade";
                         $result_atv = mysqli_query($link,$sql_atv);
                         $qr_atv = mysqli_fetch_assoc($result_atv);
                         if($qr_atv != null){
                             $msg = true;
                             $nota = $qr_atv['nota'];
                         }else {
                            $msg = false;
                        }   
                         if($msg){
                             if($nota >=6){
                             echo "<div>Nota: <span style='color: green;'>".$qr_atv['nota'].".0</span></div>"; }
                             else{
                                echo "<div>Nota: <span style='color: red;'>".$qr_atv['nota'].".0</span></div>";
                             }
                         }
                         ?>
                         
                         
                         <button <?php if($msg){echo "disabled";}else{echo '';}  ?> class='mb-3 btn btn-outline-dark'>Adicionar nota </button>
                         <?php if($msg){echo "<a href='http://localhost/templates/professor/listaAAed.php?turma=".$turma."&atividade=".$atividade."&aluno=".$id_aluno."' class='like-button'> Editar Nota </a>";} ?>
                       </form> <?php  ?> </div>
            <?php } ?>

            
            </div>
        </div>

    </div>
</body>

</html>