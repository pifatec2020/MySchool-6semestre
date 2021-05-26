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
    <div class='container2'>
        <h6 class='display-5'>Nota das respecitivas atividades</h6>

    </div>
    <div class='middle2'>
        <table class='table table-primary table-striped'>
            <thead>
                <tr>
                    <th scope="">Atividade</th>
                    <th style="text-align: right;" scope="">Nota</th>
                </tr>
            </thead>
        </table>

        <?php
        while ($qr = mysqli_fetch_assoc($result)) {
            $titulo = $qr['titulo'];
            $id_atividade = $qr['id'];
            $sql_nota = "select * from aluno_nota where id_aluno = '$id_aluno' AND id_atividade = '$id_atividade'";
            $result_nota = mysqli_query($link, $sql_nota);
            $qr_nota = mysqli_fetch_assoc($result_nota);
            if ($qr_nota == Null) {
                $nota = 0;
            } else {
                $nota = $qr_nota['nota'];
            }
        ?>
            <div class="container">
                <div class="row justify-content mb-3 div-sao2">
                    <div class="bg-normal col-md-6 "><?=$titulo?></div>
                    <div style="text-align: right;" class="bg-normal col-md-6 "><?php if($nota>=6){echo "<span style='color:darkgreen'>".$nota.".0</span>";}else{echo "<span style='color:red'>".$nota.".0</span>";}?></div>
                </div>
            </div>
        <?php } ?>


    </div>
</body>

</html>