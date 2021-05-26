<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
$error = '';
if(isset($_GET['error'])){
    $error = $_GET['error'];
}

$num = 0;
if (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    if ($mensagem == 1) {
        $num = 1;
    }
}


?>
<!DOCTYPE html>
<html>
<title>Curso</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href='./style/disciplinaform.css'>
<link rel="stylesheet" href='./style/menu2.css'>
<?php
include('../include/w3school.php');
include('../include/bootstrap.php');
?>


<body>
    <?php
    include('../include/navbar.php');
    include('../include/sidebar.php');


    ?>
    <div class='conteudo'>
        <div class='container'>
            <p class='display-6'>Formulário de cadastro ( Aluno )</p>

            <div class='col-md-6'>
                <form action="./query/alunosave.php" method="POST" enctype="multipart/form-data">
                        <input class='form-control' type="text" name="nome" placeholder="Nome completo" required>
                    <?php if($error=='user'){echo  " <input style='border: 3px solid red;' class='form-control mt-2' type='text' name='usuario' placeholder='Usuario' required> 
                                                     <div style='color: red;'> usuario já cadastrado, favor escolher outro </div>
                                                    ";}
                    else{ echo  " <input class='form-control mt-2' type='text' name='usuario' placeholder='Usuario' required> ";}?>
                    <input class='form-control mt-2' type="password" name="senha" placeholder="Senha" required>
                    <?php if($error=='cpf'){echo  " <input style='border: 3px solid red;' class='form-control mt-2' type='text' name='cpf' placeholder='CPF: 000.000.000-00' required> 
                                                     <div style='color: red;'> cpf já cadastrado</div>
                                                    ";}
                    else{ echo  " <input class='form-control mt-2' type='text' name='cpf' placeholder='CPF: 000.000.000-00' required> ";}?>
                    <input class='form-control mt-2' type="text" name="rg" placeholder="RG" required>
                    <input class='form-control mt-2' type="email" name="email" placeholder="E-mail" required>
                    <input class='form-control mt-2' type="text" name="telefone" placeholder="Telefone" required>
                    <div class='mt-2'>Selecione um genero:</div>
                    <select class='form-control' name="genero">
                        <option value="h"> Homem </option>
                        <option value="m"> Mulher</option>
                        <option value="nb"> Não-Binário</option>
                    </select>
                    <div class='mt-2'>Selecione uma foto:</div>
                    <input class='form-control' type="file" name="file" required>
                    <div><?php if($error == 'jpg'){echo "<span style='color: red;'> Arquivo não comativel (selecionar JPG) </span>";} ?></div>

                    <input class='btn btn-outline-dark mt-2' type="submit" name="acao" value="enviar">

                </form>
            </div>
        </div>

    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>