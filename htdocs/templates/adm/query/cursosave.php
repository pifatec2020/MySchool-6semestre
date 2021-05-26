<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$duracao = $_POST['duracao'];
$user = $_SESSION['user'];


$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('create','criou um curso, nome: $nome','$user')";
$sql = "insert into curso(nome,descricao,duracao) values('$nome','$descricao','$duracao')";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}


?>