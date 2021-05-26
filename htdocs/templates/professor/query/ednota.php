<?php
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();


$nota = $_POST['nota'];
$atividade = $_POST['atividade'];
$turma = $_POST['turma'];
$id = $_POST['id'];

$sql = "update aluno_nota set nota='$nota' where id='$id'"; 
if(mysqli_query($link,$sql)){
    header("Location: http://localhost/templates/professor/listaAA.php?turma=".$turma."&atividade=".$atividade."");
}else{
    echo "something wrong happens here";
}

// header('Location: http://localhost/templates/professor/query/save.php');


// echo $idaula;
?>