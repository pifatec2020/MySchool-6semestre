<?php
session_start();

require_once('../dbCoonection.php');
$user = $_POST['user'];
$password = $_POST['password'];

$objDb = new db();
$link = $objDb->connection_mysql();

$sql_log = "INSERT INTO log(action,description,usuario) VALUES ('login','entrou no sistema','$user')";

//adm
$sql_adm = " SELECT * FROM adm WHERE nome = '$user' AND senha = '$password' AND ativo_sn = 's'";
$result_adm = mysqli_query($link,$sql_adm);
$qr_adm = mysqli_fetch_assoc($result_adm);


//prof
$sql_prof = " SELECT * FROM professor WHERE usuario = '$user' AND senha = '$password' AND ativo_sn = 's'";
$result_prof = mysqli_query($link,$sql_prof);
$qr_prof = mysqli_fetch_assoc($result_prof);

//aluno
$sql_aluno = " SELECT * FROM aluno WHERE usuario = '$user' AND senha = '$password' AND ativo_sn = 's'";
$result_aluno = mysqli_query($link,$sql_aluno);
$qr_aluno = mysqli_fetch_assoc($result_aluno);


//log
$log = " SELECT * FROM user_log WHERE user = '$user' AND password = '$password'";
$result_log = mysqli_query($link,$log);
$qr_log = mysqli_fetch_assoc($result_log);


if($qr_adm != Null){
    $_SESSION['user'] = $qr_adm['nome'];
    $_SESSION['type'] = $qr_adm['user_type'];
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/adm/admenu.php');
}elseif($qr_prof != Null){
    $_SESSION['user'] = $qr_prof['usuario'];
    $_SESSION['type'] = $qr_prof['user_type'];
    $_SESSION['cpf'] = $qr_prof['cpf'];
    $_SESSION['id']= $qr_prof['id'];
    $_SESSION['nome'] = $qr_prof['nome'];
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/professor/profmenu.php');
}elseif($qr_aluno != Null){
    $_SESSION['user'] = $qr_aluno['usuario'];
    $_SESSION['type'] = $qr_aluno['user_type'];
    $_SESSION['cpf'] = $qr_aluno['cpf'];
    $_SESSION['id'] = $qr_aluno['id'];
    $_SESSION['nome'] = $qr_aluno['nome'];
    $_SESSION['id_aluno'] = $qr_aluno['id'];
    mysqli_query($link,$sql_log);
    header('Location: http://localhost/templates/aluno/aluno.php');
}elseif($qr_log != Null){
    $_SESSION['type'] = $qr_log['user_type'];
    $_SESSION['user'] = $qr_log['user'];
    header('Location: http://localhost/templates/log/log.php');

}else{
    header('Location: http://localhost/index.php?error=1');
}  


















// $result = mysqli_query($link,$sql);
// if($result != true){
// mysqli_query($link,$sql_log);
// $dateUser = mysqli_fetch_array($result);
// if($dateUser['user_type'] == 'm'){
// $_SESSION['type'] = $dateUser['user_type'];
// $_SESSION['user'] = $dateUser['nome'];
// $type = $dateUser['user_type'];
// header('Location: http://localhost/templates/adm/admenu.php');
// }elseif(1 == 1){
//     echo 'xana';
// }


// }else{
//     header('Location: http://localhost/index.php?error=1');
// }
?>