<?php
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

if(isset($_POST['option'])){
$size = $option[] = $_POST['option'];
}else {header('Location: http://localhost/templates/professor/aulas.php');}

intval($sz = count($size)).'<br/>';
// $num = intval(1);
// $resp = intval($sz) - $num;   
$idaula = $_POST['idaula'];
for($i = 0; $i<$sz; $i++){
    $aluno = $option[0][$i].'<br/>';
    // echo $aluno;
    $sql = "insert into aula_aluno(id_aula,id_aluno,frequencia) values('$idaula','$aluno',1)";
    $result = mysqli_query($link,$sql);
    if($result){
        echo "alright !";
    }else { echo "damn !";}
    
}
header('Location: http://localhost/templates/professor/query/save.php');


// echo $idaula;
?>