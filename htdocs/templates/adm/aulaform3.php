<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
$error = 0;
if(isset($_GET['error'])){
    $error = $_GET['error'];
}

$idp = $_GET['idp'];
$idisc = $_GET['id'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql_disc = "select * from disciplina where id = $idisc";
$result_disc = mysqli_query($link, $sql_disc);
$qr_disc_nome = mysqli_fetch_assoc($result_disc);
$nome_disc = $qr_disc_nome['nome'];

$sql_cursodisc = "select * from curso_disciplina where id_disciplina = $idisc";
$result_sql_cursodisc = mysqli_query($link, $sql_cursodisc);



?>
<!DOCTYPE html>
<html>
<title>Aula</title>
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
        <div class='display-6 container'>Cadastrar Aula na disciplina: <?php echo "<span>" . $nome_disc . " </span>"; ?>
            <div class='col-md-6 mt-2'>
                <form action="./query/aulasave.php" method='POST'>
                    <div style="font-size: 20px;">Selecione o Curso/Semestre que deseja cadastrar a Aula:</div>
                    <select name="id_turma" class='form-control'>
                        <?php
                        while ($qr_cursodisc = mysqli_fetch_assoc($result_sql_cursodisc)) {
                            $id_curso = $qr_cursodisc['id_curso'];
                            $sql_curso = "select * from curso where id = $id_curso";
                            $result_sql_curso = mysqli_query($link, $sql_curso);
                            $qr_curso = mysqli_fetch_assoc($result_sql_curso);
                            $nome_curso = $qr_curso['nome'];

                            $sql_turma = "select * from turma where id_curso = $id_curso";
                            $result_sql_turma = mysqli_query($link, $sql_turma);
                            while ($qr_turma = mysqli_fetch_assoc($result_sql_turma)) {
                                $id_turma = $qr_turma['id'];
                                $semestre = $qr_turma['semestre'];
                                echo "<option value = '" . $id_turma . "'> " . $nome_curso . " - " . $semestre . "° semestre </option>";
                            }
                        }
                        ?>
                    </select>
                    <input class='d-none' name="disc" value="<?php echo $idisc; ?>">
                    <input class='d-none' name="idp" value="<?php echo $idp; ?>">
                    <input class='form-control mt-2' name="data" type="date" min='2021-04-29' max='2021-12-16' required>
                    <textarea class='form-control mt-2' name="descricao" cols="10" rows="5" required></textarea>
                    <div style="font-size: 18px">Quantidade de aulas:</div>
                    <div class='col-md-2'>
                        <input class='form-control' name="quantidade" type="number" min='1' max='4' required>
                    </div>
                    <button class='btn btn-outline-dark mt-1'>Cadastrar Aula</button>
                </form>
                <?php if($error != 0){echo "<span style='color: red;'>Quantidade escolhida excede o limite maximo de 4 aulas por data </span>";} ?>
            </div>
        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>