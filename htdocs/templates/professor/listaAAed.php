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
$aluno = $_GET['aluno'];

$sql = "select * from aluno_nota where id_aluno = $aluno AND id_atividade = $atividade";
$result = mysqli_query($link, $sql);

$qr = mysqli_fetch_assoc($result);
$nota = $qr['nota'];
$id = $qr['id'];

$sql_a = "select * from aluno where id = $aluno";
$result_a = mysqli_query($link,$sql_a);
$qr_a = mysqli_fetch_assoc($result_a);
$nome = $qr_a['nome'];
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
               <div class='col-md-4'>
                <form action="./query/ednota.php" method="POST">
                    <table class='table table-borderless table-hover table-sm table-striped'>
                       <tr>
                         <td><?=$nome?></td>
                         <td><input style='float:right; width: 70px;' name="nota" type="number" value="<?=$nota?>" required min='0' max='10'></td>
                       </tr>
                    </table>
                    <input value='<?=$atividade?>' name="atividade" class="d-none">
                    <input value='<?=$turma?>' name="turma" class="d-none">
                    <input value='<?=$id?>' name="id" class="d-none">
                    <button class='btn btn-outline-dark'>Editar</button>
                </form>
               </div>
            </div>
        </div>

    </div>
</body>

</html>