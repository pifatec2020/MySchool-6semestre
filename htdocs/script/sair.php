<?php 
session_start();

require_once('../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$user = $_SESSION['user'];

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('logout','saiu do sistema','$user')";
mysqli_query($link,$sql_log);
unset($_SESSION['user']);
header('Location: http://localhost/');

?>