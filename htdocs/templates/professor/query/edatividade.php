<?php
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id = $_POST['id'];
$id_turma = $_POST['id_turma'];
$idpd = $_POST['id_pd'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data = $_POST['data'];

$sql = "update atividade set titulo='$titulo', data_entrega='$data', descricao='$descricao' where id='$id'"; 
if(mysqli_query($link,$sql)){
    header('Location: http://localhost/templates/professor/query/save.php');
}else{
    echo "something wrong happens here";
}

// header('Location: http://localhost/templates/professor/query/save.php');


// echo $idaula;
?>