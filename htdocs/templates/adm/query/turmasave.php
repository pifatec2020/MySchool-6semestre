<?php 
session_start();


require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$user = $_SESSION['user'];
$msg = true;

$id_curso = $_POST['id_curso'];
$semestre = $_POST['semestre'];


$sql_curso = "select * from curso where id = $id_curso";
$resultc = mysqli_query($link,$sql_curso);
$qr_curso = mysqli_fetch_assoc($resultc);
$nome_curso = $qr_curso['nome'];


$sql_find_turma = "select * from turma";
$result_turma = mysqli_query($link,$sql_find_turma);
while ($qr_turma = mysqli_fetch_assoc($result_turma)){
    if($id_curso == $qr_turma['id_curso'] && $semestre == $qr_turma['semestre']){
        $msg = false;
    }
}


        if($msg){
            $sql_log = "INSERT INTO log(action,description,usuario) VALUES('create','criou uma turma [ semestre: $semestre, curso: $nome_curso ]','$user')";
            $sql = "insert into turma(semestre,id_curso) values('$semestre','$id_curso')";
            mysqli_query($link,$sql);
            mysqli_query($link,$sql_log);
            header('Location: http://localhost/templates/adm/query/save.php');
        }else{
            header('Location: http://localhost/templates/adm/turmaform.php?error=1');
        }





?>