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
            include('./include/menu-d.php');
            ?>


            <div class="conteudo">
                <h4>Suas disciplinas:</h4>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            
                                <?php while ($qr = mysqli_fetch_assoc($result)) {
                                    $id_disc = $qr['id_disciplina'];
                                    $sql_disc = "select * from disciplina where id = $id_disc ";
                                    $result_disc = mysqli_query($link, $sql_disc);
                                    $qr_disc = mysqli_fetch_assoc($result_disc);
                                    $nome = $qr_disc['nome'];
                                    $carga = $qr_disc['carga_horaria'];
                                    echo "<tr><td><a class='link-disc' href=''>" . $nome . " </a></td> <td><span class='none'> " . $carga . " horas </span></td></td></tr>";
                                }   ?>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</body>

</html>