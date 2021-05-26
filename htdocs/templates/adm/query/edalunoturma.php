<?php 
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$user = $_SESSION['user'];
$id_aluno = $_GET['id_aluno'];
$id_turma = $_GET['turma'];

echo $id_aluno.'<br/>'.$id_turma;

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('edit','modificou a turma do aluno id:[$id_aluno] para turmaID:[$id_turma]','$user')";
$sql = "UPDATE aluno_turma SET id_turma='$id_turma' WHERE id_aluno = $id_aluno";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'badway getway';
}




?>