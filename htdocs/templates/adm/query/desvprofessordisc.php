<?php 
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$msg = true;

$user = $_SESSION['user'];
$id_prof = $_GET['id_professor'];
$id_disciplina = $_GET['id'];
$nomeprof = $_GET['nome'];
$sql_disc = "select * from disciplina where id = $id_disciplina";
$result_disc = mysqli_query($link,$sql_disc);
$qr_disc = mysqli_fetch_assoc($result_disc);
$nome_disc = $qr_disc['nome'];

$sql_log = "insert into log(action,description,usuario) values('delete','Desvinculou disciplina $nome_disc do professor $nomeprof','$user')";
$sql_search = "select * from professor_disciplina where id_professor = '$id_prof' AND id_disciplina = '$id_disciplina'";
$result_search = mysqli_query($link,$sql_search);
while($qr_search = mysqli_fetch_assoc($result_search)){
    $idpd = $qr_search['id'];
    $sql_search_aula = "select * from aula where id_pd = $idpd";
    $result_search_aula = mysqli_query($link,$sql_search_aula);
    $qr_search_aula = mysqli_fetch_assoc($result_search_aula);
    if($qr_search_aula == NULL){
        $sql_delete = "delete from professor_disciplina where id_professor = '$id_prof' AND id_disciplina = '$id_disciplina' ";
        if(mysqli_query($link,$sql_delete)){
            mysqli_query($link,$sql_log);
            header('Location: http://localhost/templates/adm/query/save.php');
        }else{echo 'xii....';}
    } else{
        header("Location: http://localhost/templates/adm/vsprofessor.php?error=aula&idp=$id_prof");
    }
    
}
