<?php
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$aluno = $_POST['id_aluno'];
$atividade = $_POST['atividade'];
$nota = $_POST['nota'];
$turma = $_POST['turma'];

$sql = "insert into aluno_nota(id_atividade,id_aluno,nota) values('$atividade','$aluno','$nota')";
if(mysqli_query($link,$sql)){
    header("Location: http://localhost/templates/professor/listaAA.php?turma=".$turma."&atividade=".$atividade."");
}else{
    echo "something wrong happens here";
}

// header('Location: http://localhost/templates/professor/query/save.php');


// echo $idaula;
?>