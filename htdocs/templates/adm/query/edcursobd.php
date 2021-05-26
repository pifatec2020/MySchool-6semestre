<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id = $_POST['id'];
$nome = $_POST['curso'];
$descricao = $_POST['descricao'];
$user = $_SESSION['user'];

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('edit','usuario: $user editou o curso [id: $id] para $nome','$user')";
$sql = "UPDATE curso SET nome='$nome', descricao='$descricao' WHERE id=$id";

if(mysqli_query($link,$sql)){
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/query/save.php');
}else{
    echo 'Error';
}


?>