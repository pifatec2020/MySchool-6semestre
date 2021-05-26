<?php
session_start();
require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$id_professor = $_POST['id_professor'];
$user = $_SESSION['user'];
$nome_professor = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$genero = $_POST['genero'];

$sql_professor = "update professor set nome = '$nome_professor', usuario = '$usuario',senha = '$senha',cpf = '$cpf',rg = '$rg',email = '$email', telefone = '$telefone', genero = '$genero' where id = $id_professor";
$sql_log = "insert into log(action,description,usuario) values('Edit','editou o professor $nome_professor','$user')";

$file = $_FILES['file'];
if(!$file['tmp_name']== null){
 

if (isset($_POST['acao'])) {
    $arqv = $_FILES['file'];

    $arqvNovo = explode('.', $arqv['name']);
    if ($arqvNovo[sizeof($arqvNovo) - 1] != 'jpg') {
        header("Location: http://localhost/templates/adm/edprofessor.php?id_professor=".$id_professor."&error=jpg");
    } else {
        echo 'Podemos continuar';
        move_uploaded_file($arqv['tmp_name'], 'uploads/' . md5($arqv['name']) . '.jpg');
        $nome = md5($arqv['name']) . '.jpg';
        $sql = "insert into upload_img(arquivo,id_user) values('$nome','$cpf')";
        $sql_delete = "delete from upload_img where id_user = $cpf";
        mysqli_query($link,$sql_delete);
        if (mysqli_query($link, $sql)) {
           if(mysqli_query($link,$sql_professor)){
               mysqli_query($link,$sql_log);
               header('Location: http://localhost/templates/adm/query/save.php');
           }
        } else {
            header('Location: http://localhost/templates/adm/professorform.php?error=1');
        }
    }
}}
else{
    if(mysqli_query($link,$sql_professor)){
        mysqli_query($link,$sql_log);
        header('Location: http://localhost/templates/adm/query/save.php');
    }else{
        echo 'error';
    }
}


?>
