<?php
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id_turma = $_POST['id_turma'];
$idpd = $_POST['id_pd'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data = $_POST['data'];

$sql = "insert into atividade(id_turma,id_professor_disciplina,titulo,descricao,data_entrega) values('$id_turma','$idpd','$titulo','$descricao','$data')";
if(mysqli_query($link,$sql)){
    header('Location: http://localhost/templates/professor/query/save.php');
}else{
    echo "something wrong happens here";
}

// header('Location: http://localhost/templates/professor/query/save.php');


// echo $idaula;
?>