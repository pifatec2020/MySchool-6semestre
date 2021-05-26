<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
$msg = false;
$user = $_SESSION['user'];

require('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$idisc = $_POST['disc'];
$quantidade = $_POST['quantidade'];
$id_turma = $_POST['id_turma'];
$id_pd = $_POST['idp'];
$data = $_POST['data'];
$descricao = $_POST['descricao'];
$search = 0;


$sql_aluno = "select * from aluno_turma where id_turma = $id_turma";
$resultado = mysqli_query($link,$sql_aluno);
if(isset($resultado)){
while($qr_aluno = mysqli_fetch_assoc($resultado)){
    $id_aluno = $qr_aluno['id_aluno'];
    $num = 0;
    $sql_aluno_aula = "insert into aluno_aula(id_aluno,id_turma,frequencia) values('$id_aluno','$id_turma','$num')";
    mysqli_query($link,$sql_aluno_aula);
}}else {echo 'ERROR';}




$sql_log = "insert into log(action,description,usuario) values('create','Criou uma aula, data: '$data', '$user')";
$sql_aula = "select quantidade from aula where data = '$data' AND id_pd = $id_pd AND id_turma = $id_turma";

$sr_aula = mysqli_query($link,$sql_aula);
$qr = mysqli_fetch_all($sr_aula);
$c = count($qr);
$c;
for($i = 0; $i<$c; $i++){
    $num += $qr[$i][0];
}

if($quantidade == 4 AND $num >=1){
    header("Location: http://localhost/templates/adm/aulaform3.php?idp=$id_pd&id=$idisc&error=full");
}elseif($quantidade == 3 AND $num>=2){
    header("Location: http://localhost/templates/adm/aulaform3.php?idp=$id_pd&id=$idisc&error=full");
}elseif($quantidade == 2 AND $num>=3){
    header("Location: http://localhost/templates/adm/aulaform3.php?idp=$id_pd&id=$idisc&error=full");
}elseif($quantidade == 1 AND $num>=4){
    header("Location: http://localhost/templates/adm/aulaform3.php?idp=$id_pd&id=$idisc&error=full");
}elseif($qr != null){
     $num += $quantidade;
        $sql_update = "update aula SET quantidade = '$num' where data = '$data' AND id_pd = '$id_pd' AND id_turma = '$id_turma'";
        $result_upd = mysqli_query($link,$sql_update);
        if($result_upd){
        header('Location: http://localhost/templates/adm/query/save.php');
    }}


if($qr == null){
$sql = "insert into aula(data,descricao,id_turma,id_pd,quantidade) values('$data','$descricao','$id_turma','$id_pd','$quantidade')";
$sqlds = "insert into ds(id_pd,id_turma) values('$id_pd','$id_turma')";

$sql_ds_search = "select * from ds where id_pd = $id_pd AND id_turma = $id_turma";
$result_ds = mysqli_query($link,$sql_ds_search);
$qr_ds = mysqli_fetch_assoc($result_ds);

var_dump($qr_ds);
if($qr_ds == Null){
    mysqli_query($link,$sqlds); 
}else { $pe = 0; }
$resultado = mysqli_query($link,$sql);

if($resultado){
mysqli_query($link,$sql_log);
header('Location: http://localhost/templates/adm/query/save.php');
}}






?>