<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id = $_POST['id'];
$nome = $_POST['nome'];
$hora = $_POST['hora'];
$user = $_SESSION['user'];

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('edit','editou a disciplina [id: $id] para $nome','$user')";
$sql = "UPDATE disciplina SET nome='$nome', carga_horaria='$hora' WHERE id=$id";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}



?>