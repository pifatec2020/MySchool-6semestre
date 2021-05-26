<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$id = $_POST['id'];
echo $titulo.'<br/>'.$descricao;


require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql = "UPDATE aviso SET titulo = '$titulo', descricao = '$descricao' WHERE id = '$id' ";
$result = mysqli_query($link,$sql);
if($result){
    header('Location: http://localhost/templates/adm/query/save.php');
}



?>