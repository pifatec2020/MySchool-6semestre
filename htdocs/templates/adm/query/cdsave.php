<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id_curso = $_POST['id_curso'];
$id_disciplina = $_POST['id_disciplina'];
$user = $_SESSION['user'];

require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$find_c = "select nome from curso where id = $id_curso";
$find_d = "select nome from disciplina where id = $id_disciplina";

$result_c = mysqli_query($link,$find_c);
$qr_c = mysqli_fetch_assoc($result_c);
$nome_curso = $qr_c['nome'];

$result_d = mysqli_query($link,$find_d);
$qr_d = mysqli_fetch_assoc($result_d);
$nome_disc = $qr_d['nome'];

$msg = true;

$sql_cd = "select * from curso_disciplina";
$result_cd = mysqli_query($link,$sql_cd);

while ($qrcd = mysqli_fetch_assoc($result_cd)){
    if($id_curso == $qrcd['id_curso'] && $id_disciplina == $qrcd['id_disciplina']){
        $msg = false;
    }
}


        if($msg){
            $sql_log = "INSERT INTO log(action,description,usuario) VALUES ('add','vinculou a disciplina $nome_disc no curso $nome_curso','$user')";
            $sql = "insert into curso_disciplina(id_curso,id_disciplina) values('$id_curso','$id_disciplina')";
            $result = mysqli_query($link,$sql);
            mysqli_query($link,$sql_log);
            header('Location: http://localhost/templates/adm/query/save.php');
        }else{
            header('Location: http://localhost/templates/adm/disciplinacursoform.php?error=1');
        }




?>