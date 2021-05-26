<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id_professor = $_POST['id_professor'];
$id_disciplina = $_POST['id_disciplina'];
$user = $_SESSION['user'];

require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$find_p = "select nome from professor where id = $id_professor";
$find_d = "select nome from disciplina where id = $id_disciplina";

$result_p = mysqli_query($link,$find_p);
$qr_p = mysqli_fetch_assoc($result_p);
$nome_professor = $qr_p['nome'];

$result_d = mysqli_query($link,$find_d);
$qr_d = mysqli_fetch_assoc($result_d);
$nome_disc = $qr_d['nome'];

$msg = true;

$sql_pd= "select * from professor_disciplina";
$result_pd = mysqli_query($link,$sql_pd);

while ($qrpd = mysqli_fetch_assoc($result_pd)){
    if($id_professor == $qrpd['id_professor'] && $id_disciplina == $qrpd['id_disciplina']){
        $msg = false;
    }
}


        if($msg){
            $sql_log = "INSERT INTO log(action,description,usuario) VALUES ('add','vinculou o professor $nome_professor na disciplina $nome_disc','$user')";
            $sql = "insert into professor_disciplina(id_professor,id_disciplina) values('$id_professor','$id_disciplina')";
            $result = mysqli_query($link,$sql);
            mysqli_query($link,$sql_log);
            header('Location: http://localhost/templates/adm/query/save.php');
        }else{
            header('Location: http://localhost/templates/adm/professordisciplinaform.php?error=1');
        }




?>