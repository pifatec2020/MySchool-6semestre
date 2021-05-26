<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$quantidade = $_GET['quantidade'];
$turma = $_GET['id_turma'];
$aula = $_GET['id_aula'];
$nomed = $_SESSION['nomed'];


$sql = "select * from aluno_turma where id_turma = $turma";
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

                <h4>Alunos da disciplina: <span style='color: brown'><?= $nomed ?></span></h4>
                
                <div class='aula'>
                        <div class="container">
                        <form action="./query/falta.php" method="POST">
                            <?php
                            while ($qr = mysqli_fetch_assoc($result)) {
                                $id_aluno = $qr['id_aluno'];
                                $sql_a = "select * from aluno where id = $id_aluno";
                                $result_aluno = mysqli_query($link, $sql_a);
                                $qr_aluno = mysqli_fetch_assoc($result_aluno);
                                $cpf = $qr_aluno['cpf'];
                                $nome = $qr_aluno['nome'];

                                $sql_img = "select * from upload_img where id_user = $cpf";
                                $result_img = mysqli_query($link, $sql_img);
                                $qr_img = mysqli_fetch_assoc($result_img);
                                $img = $qr_img['arquivo'];
                                echo "<div> <img class='rnd-img' src='../adm/query/uploads/".$img."' > <span class='s-name'>" . $nome . "</span> 
                                </div> <form>  ";
                                 for($i = 0; $i < $quantidade; $i++){
                                    $al = $i + 1;
                                    echo "<span>Aula ".$al." </span>"; 
                                    echo "<input class='mgr' type='checkbox' name='option[]' value='".$id_aluno."'>";
                                 }   
                                 echo "<div>______________________________</div>";
                            }

                            ?>
                            <input class="d-none" name="idaula" value="<?= $aula ?>">
                            <div> <button class='btn-aula' type="submit">Salvar</button></div>
                            </form>
                        </div>
                        
                </div>

            </div>
        </div>

    </div>
</body>

</html>