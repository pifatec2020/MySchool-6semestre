<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id = $_SESSION['id'];
$sql = "select * from professor_disciplina where id_professor = $id";
$result = mysqli_query($link, $sql);

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

            <h4>Selecione a disciplina:</h4>
            <?php while($qr = mysqli_fetch_assoc($result)){
                $idpd = $qr['id'];
                $id_disc = $qr['id_disciplina'];
                $sqld = "select * from disciplina where id = $id_disc";
                $sqlc = "select * from curso_disciplina where id_disciplina = $id_disc";
                $resultc = mysqli_query($link,$sqlc);
                $qrc = mysqli_fetch_assoc($resultc);
                $idcurso = $qrc['id_curso'];
                $sqlcurso = "select * from curso where id = $idcurso";
                $resultcurso = mysqli_query($link,$sqlcurso);
                $qrcurso = mysqli_fetch_assoc($resultcurso);
                $nomecurso = $qrcurso['nome'];
                $resultd = mysqli_query($link,$sqld);
                $qrd = mysqli_fetch_assoc($resultd);
                $dnome = $qrd['nome'];
                echo "<a href='http://localhost/templates/professor/au1as.php?id=".$idpd."&idd=".$id_disc."' class='link-disc' ><div>".$dnome." - curso (".$nomecurso.")</div></a>";
            } ?>
           
            </div>
        </div>

    </div>
</body>

</html>