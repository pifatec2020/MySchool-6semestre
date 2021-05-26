<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


$num = 0;
if(isset($_GET['error'])){
$mensagem = $_GET['error'];
if($mensagem == 1){
$num=1;
}}



require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from curso";
$result = mysqli_query($link, $sql);


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
            <p class='display-6'>Formulário de cadastro ( Turma )</p>

            <div class='col-md-6'>
                <form action="./query/turmasave.php" method="POST">
                    <span>Selecione o curso: </span>
                    <select class='form-control' name="id_curso" id="" required>
                        <?php while ($qr_curso = mysqli_fetch_assoc($result)) {
                            echo " <option value='".$qr_curso['id']."'> ".$qr_curso['nome']." </option> ";
                        } ?>
                    </select>
                    <div class='mt-2'>Digite o semestre da turma: </div>
                    <input class='form-control' name="semestre" type="number" min='1' max='6' required placeholder="Semestre da turma">
                    <?php if($num == 1) { echo "<span style='color: red;'> Turma já cadastrada </span> <br/>"; } ?>
                    <button class='btn btn-outline-primary mt-2'>Cadastrar</button>

                </form>
            </div>
        </div>

    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>