<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id_professor = $_GET['id_professor'];

$error = '';
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
<link rel="stylesheet" href='./style/professor.css'>
<?php
include('../include/w3school.php');
include('../include/bootstrap.php');
?>


<body>
    <?php
    include('../include/navbar.php');
    include('../include/sidebar.php');
    ?>

    <?php 
    require_once('../../dbCoonection.php');
                $objDb = new db();
                $link = $objDb->connection_mysql();
                $sql_professor = "select * from professor where id = $id_professor";
                $result = mysqli_query($link, $sql_professor);
                $qr_professor = mysqli_fetch_assoc($result);

        $nome = $qr_professor['nome'];
        $usuario = $qr_professor['usuario'];
        $senha = $qr_professor['senha'];
        $cpf = $qr_professor['cpf'];
        $rg = $qr_professor['rg'];
        $email = $qr_professor['email'];
        $telefone = $qr_professor['telefone'];
    ?>


    <div class='conteudo'>
    <div class='container'>
            <p class='display-6'>Editar user: <?php echo $usuario ?></p>

            <div class='col-md-6'>
                <form action="./query/edprofessorsave.php" method="POST" enctype="multipart/form-data">
                    <input class='d-none' value='<?php echo $id_professor ?>' name="id_professor">
                    <div>Nome: </div>
                    <input class='form-control' type="text" name="nome" placeholder="Nome completo" value="<?php echo $nome ?>">
                    <div class='mt-2'>Senha:</div>
                    <input class='form-control d-none' type="text" name="usuario" placeholder="Usuario" required value="<?php echo $usuario ?>">
                    <input class='form-control' type="password" name="senha" placeholder="Senha" required value="<?php echo $senha ?>">
                    <div class='mt-2'>Rg:</div>
                    <input class='form-control d-none' type="text" name="cpf" placeholder="CPF: 000.000.000-00" required value="<?php echo $cpf ?>">
                    <input class='form-control' type="text" name="rg" placeholder="RG" required value="<?php echo $rg ?>">
                    <div class='mt-2'>E-mail:</div>
                    <input class='form-control' type="email" name="email" placeholder="E-mail" required value="<?php echo $email ?>">
                    <div class='mt-2'>Telefone:</div>
                    <input class='form-control' type="text" name="telefone" placeholder="Telefone" required value="<?php echo $telefone ?>">
                    <div class='mt-2'>Selecione um genero:</div>
                    <select class='form-control' name="genero">
                        <option value="h"> Homem </option>
                        <option value="m"> Mulher</option>
                        <option value="nb"> Não-Binário</option>
                    </select>
                    <div class='mt-2'>Selecione uma foto:</div>
                    <input class='form-control' type="file" name="file">
                    <div><?php if($error == 'jpg'){echo "<span style='color: red;'> Arquivo não comativel (selecionar JPG) </span>";} ?></div>

                    <input class='btn btn-outline-dark mt-2' type="submit" name="acao" value="Editar">

                </form>
            </div>
        </div>

    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>