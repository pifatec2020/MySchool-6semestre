<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'p') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$idpd = $_GET['idpd'];
// $id = $_SESSION['id'];
// $sql = "select * from professor_disciplina where id_professor = $id";
// $result = mysqli_query($link, $sql);
$sql = "select * from ds where id_pd = $idpd";
$result = mysqli_query($link,$sql);
$qr = mysqli_fetch_assoc($result);
if($qr){
    $id_turma = $qr['id_turma'];
}else{
    $id_turma = '';
}

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

            <?php if($id_turma === ''){
                echo "<div class='mt-5' style='color: red;'> Para cadastrar uma atividade, é necessario que a disciplina tenha alguma aula cadastrada. </div>";

            }else{
                echo "<div class='col-md-5 mt-5'>
                          <form action='./query/atividade.php' method='POST' class=''> 
                             <div class=''> Título da atividade: </div>
                             <input style='display: none;' value='".$id_turma."' name='id_turma' >
                             <input style='display: none;' value='".$idpd."' name='id_pd' >
                             <input class='form-control' type='text' name='titulo' placeholder='Digite o titulo da atividade' required>  
                             <div class='mt-2'>Descrição da atividade: </div>
                             <textarea class='form-control' name='descricao'>Digite a descrição da atividade...  </textarea>
                             <div class='mt-2'> Data de entrega: </div>
                             <div class='col-md-4'><input name='data' type='date' class=' form-control' required></div>
                             <button class='mt-4 btn btn-outline-dark'>Salvar Atividade </button>
                         </form>
                     </div>";
            } ?>

            


            <div class="conteudo">
            <form action="">
            
            </div>
        </div>

    </div>
</body>

</html>