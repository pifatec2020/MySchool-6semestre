<?php
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$user = $_SESSION['user'];
$nome_aluno = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$genero = $_POST['genero'];

$msg = false;
$msg_cpf = false;


$sql_find_aluno = "select * from aluno";
$result_find_aluno = mysqli_query($link,$sql_find_aluno);
while($qr_find_aluno = mysqli_fetch_assoc($result_find_aluno)){
    if($qr_find_aluno['usuario'] == $usuario){
        $msg = true;
    }if($qr_find_aluno['cpf'] == $cpf){
        $msg_cpf = true;
    }
}


if(!$msg_cpf){

if(!$msg){

$sql_aluno = "insert into aluno(nome,usuario,senha,cpf,rg,email,telefone,genero,ativo_sn,user_type) values('$nome_aluno','$usuario','$senha','$cpf','$rg','$email','$telefone','$genero','s','a')";
$sql_log = "insert into log(action,description,usuario) values('create','criou um aluno $nome_aluno, cpf: $cpf','$user')";
if (isset($_POST['acao'])) {
    $arqv = $_FILES['file'];

    $arqvNovo = explode('.', $arqv['name']);
    if ($arqvNovo[sizeof($arqvNovo) - 1] != 'jpg') {
        header('Location: http://localhost/templates/adm/professorform.php?error=jpg');
    } else {
        echo 'Podemos continuar';
        move_uploaded_file($arqv['tmp_name'], 'uploads/' . md5($arqv['name']) . '.jpg');
        $nome = md5($arqv['name']) . '.jpg';
        echo $nome;
        $sql = "insert into upload_img(arquivo,id_user) values('$nome','$cpf')";
        if (mysqli_query($link, $sql)) {
           if(mysqli_query($link,$sql_aluno)){
               mysqli_query($link,$sql_log);
               header("Location: http://localhost/templates/adm/alunoturma.php?id=$cpf");
           }
        } else {
            header('Location: http://localhost/templates/adm/alunoform.php?error=1');
        }
    }
}}else{
    header('Location: http://localhost/templates/adm/alunoform.php?error=user');
}}else{
    header('Location: http://localhost/templates/adm/alunoform.php?error=cpf');
}

?>
