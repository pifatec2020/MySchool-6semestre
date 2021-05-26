<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$aluno = $_GET['id'];
$sql = "select * from aluno where id = $aluno";
$result = mysqli_query($link,$sql);
$qr = mysqli_fetch_assoc($result);
$nome = $qr['nome'];

$sql_turma = "select * from turma"; 
$result_turma = mysqli_query($link,$sql_turma);



?>
<!DOCTYPE html>
<html>
<title>Semestre</title>
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


    <div class='conteudo'>
        <div class="display-6">Editar semestre do aluno(a): <?php echo $nome ?></div>
        <div class='col-md-6'>
        <form action="./query/edalunoturma.php" method="GET">
        <input class="d-none" name="id_aluno" value="<?php echo $aluno ?>">
        <select class="form-control" name="turma" id="">

            <?php 
             while($qrt = mysqli_fetch_assoc($result_turma)){
             $idt = $qrt['id'];
             $semestre = $qrt['semestre'];
             $idc = $qrt['id_curso'];
             $sql_curso = "select * from curso where id = $idc";
             $resultc = mysqli_query($link,$sql_curso);
             $qrc = mysqli_fetch_assoc($resultc);
             $nomec = $qrc['nome']; 
             echo "<option value = '".$idt."'>".$semestre."° semestre - ".$nomec." </option>";
            }  ?>
             
        </select>
        <br>
        <button class=' btn btn-outline-primary'>Editar</button>
        </form>
        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>