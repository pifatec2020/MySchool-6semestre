<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$cpf ='';
if(isset($_GET['id'])){
    $cpf = $_GET['id'];
    $sql_aluno = "select * from aluno where cpf = $cpf";
    $resulta = mysqli_query($link,$sql_aluno);
    $qr_aluno = mysqli_fetch_assoc($resulta);
    $nome_aluno = $qr_aluno['nome'];
    $id_aluno =$qr_aluno['id'];
}

$sql = "select * from turma";
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
            <div style="font-size: 30px;">Cadastrar Aluno(a): <?php echo "<span style = 'color: lightblue; font-size: 35px;'>". $nome_aluno. " </span>";  ?> em uma turma</div>
            <div class="h5 mt-2">Selecione a turma:</div>
            <div class='col-md-4'>
                <form action="./query/alunoturmasave.php" method="POST">
                    <select class='form-control' name="id_turma" id="">
                        <?php
                        while ($qr = mysqli_fetch_assoc($result)) {
                            $id_curso = $qr['id_curso'];
                            $sqlc = "select * from curso where id = $id_curso";
                            $resultc = mysqli_query($link, $sqlc);
                            $qrc = mysqli_fetch_assoc($resultc);
                            $nome_curso = $qrc['nome'];
                            $semestre = $qr['semestre'];

                            echo "<option value='" . $qr['id'] . "'>" . $semestre . "° Semestre - " . $nome_curso . " </option>";
                        }
                        ?>
                    </select>
                    <input name="id_aluno"  class='d-none' value="<?php echo $id_aluno?>">
                    <input name="nome"  class='d-none' value="<?php echo $nome_aluno?>">
                    <input name="semestre"  class='d-none' value="<?php echo $semestre?>">
                    <input name="curso"  class='d-none' value="<?php echo $nome_curso?>">
                    <button class='btn btn-outline-primary mt-2'>Cadastrar</button>
                </form>
            </div>

        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>