<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$nome = $_POST['nome'];
$duracao = $_POST['duracao'];
$user = $_SESSION['user'];


$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('create','criou uma disciplina, nome: $nome','$user')";
$sql = "insert into disciplina(nome,carga_horaria) values('$nome','$duracao')";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}


?>