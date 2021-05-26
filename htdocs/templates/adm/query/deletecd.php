<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$user = $_SESSION['user'];
$id_curso = $_POST['id_curso'];
$id_disciplina = $_POST['id_disciplina'];

$sqlcurso = "select * from curso where id = $id_curso";
$resultcurso = mysqli_query($link,$sqlcurso);
$respcurso = mysqli_fetch_assoc($resultcurso);
$nome_curso = $respcurso['nome'];

$sqld = "select * from disciplina where id = $id_disciplina";
$resultd = mysqli_query($link,$sqld);
$respd= mysqli_fetch_assoc($resultd);
$nome_d = $respd['nome'];

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('delete','desvinculou disciplina $nome_d, do curso $nome_curso','$user')";
$sql = "delete from curso_disciplina where id_curso = $id_curso AND id_disciplina = $id_disciplina";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}


?>