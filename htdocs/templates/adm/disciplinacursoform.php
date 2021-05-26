<?php
session_start();
$num = 0;
if(isset($_GET['error'])){
$mensagem = $_GET['error'];
if($mensagem == 1){
$num=1;
}
}
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql_curso = "select * from curso";
$sql_disciplina = "select * from disciplina";
$result_curso = mysqli_query($link, $sql_curso);
$result_disciplina = mysqli_query($link, $sql_disciplina);
?>


<!DOCTYPE html>
<html>
<title>Disciplina</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href='./style/menu2.css'>
<?php
include('../include/w3school.php');
include('../include/bootstrap.php');
?>


<body>
    <?php
    include('../include/navbar.php');
    include('../include/sidebar.php')
    ?>


    <div class='conteudo'>
        <div class='col-md-6 container'>
            <h1 class='display-6'>Cadastrar Disciplina no curso</h1>
            <form action='./query/cdsave.php' method='POST' class='mt-4'>
                <span style='font-size: 18px;'>Curso:</span>
                <select class='form-control' name='id_curso' id='' required>
                    <?php while ($qr_curso = mysqli_fetch_assoc($result_curso)) {
                        echo " <option value='" . $qr_curso['id'] . "'> " . $qr_curso['nome'] . " </option>";
                    }  ?>
                </select>
                <span style='font-size: 18px'>Disciplina:</span>
                <select class='form-control mt-2' name="id_disciplina" id="" required>
                    <?php while ($qr_disciplina = mysqli_fetch_assoc($result_disciplina)) {
                        echo " <option value='" . $qr_disciplina['id'] . "'> " . $qr_disciplina['nome'] . " </option>";
                    }  ?>
                </select>
                <?php if($num == 1){ echo " <span style='color: red;'> Disciplina já cadastrada para esse curso </span><br/>";} ?>
                <button class='btn btn-outline-dark mt-3' type="submit">Cadastrar</button>
            </form>
        </div>
    </div>











    <script src="./script/sidebar.js"></script>

</body>

</html>