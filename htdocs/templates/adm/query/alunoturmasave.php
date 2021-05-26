<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$user = $_SESSION['user'];

require('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();


$id_aluno = $_POST['id_aluno'];
$id_turma = $_POST['id_turma'];
$nome = $_POST['nome'];
$semestre = $_POST['semestre'];
$curso = $_POST['curso'];

$sql = "insert into aluno_turma(id_aluno,id_turma) values('$id_aluno','$id_turma')";
$sql_log = "insert into log(action,description,usuario) values('add','Adicionou aluno(a) $nome na turma $semestre ° Semestre do curso $curso','$user')";



if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}
?>