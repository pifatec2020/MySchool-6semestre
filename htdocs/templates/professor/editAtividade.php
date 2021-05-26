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
$sql = "select * from atividade where id_professor_disciplina = $idpd";
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

            <?php

            while($qr = mysqli_fetch_assoc($result)){
                $id = $qr['id'];
                $titulo = $qr['titulo'];
                $descricao = $qr['descricao'];
                $data = $qr['data_entrega'];
                $id_turma = $qr['id_turma'];

            echo "
            <div class='col-md-5 mt-4' style='border: 3px solid black; padding: 10px; border-radius: 5px; background-color: black;'>
            <a href='http://localhost/templates/professor/listaAA.php?turma=".$id_turma."&atividade=".$id."'><div style='float: right;' class='mb-1'><button class='btn btn-outline-danger'>Cadastrar notas</button></div></a>
                  <form action='./query/edatividade.php' method='POST' class=''> 
                     <input style='display: none;' value='" . $id . "' name='id' >
                     <input style='display: none;' value='" . $id_turma . "' name='id_turma' >
                     <input style='display: none;' value='" . $idpd . "' name='id_pd' >
                     <input class='form-control mt-1' type='text' name='titulo' value='".$titulo."'>  
                     <textarea class='form-control mt-1' name='descricao'>".$descricao."</textarea>
                     <div class='col-md-4 mt-1'><input name='data' type='date' value='".$data."' class=' form-control'></div>
                     <button class='mt-2 btn btn-outline-primary'>Editar Atividade </button>
                 </form>
           </div>"; }


            ?>



            <div class="conteudo">

            </div>
        </div>

    </div>
</body>

</html>