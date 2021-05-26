<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id_curso = $_GET['id'];
$nome_curso = $_GET['nome'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from curso_disciplina where id_curso = $id_curso";
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
        <ul class="list-group">
            <div class="list-group-item list-group-item-action active">
                Disciplina(s) do curso: <?php echo "<span style='font-size: 20px'> $nome_curso </span>"; ?>
            </div>
            <?php
            while ($qr_curso_disciplina = mysqli_fetch_assoc($result)) {
                $id_disciplina = $qr_curso_disciplina['id_disciplina'];
                $sql_disciplina = "select * from disciplina where id = $id_disciplina";
                $result_disciplina = mysqli_query($link, $sql_disciplina);
                $result_qr_disciplina = mysqli_fetch_assoc($result_disciplina);
                echo " <li class='list-group-item'>".$result_qr_disciplina['nome']." <form action='./query/deletecd.php' method='POST'>
                                                                                     <input class='d-none' name='id_curso' value='".$id_curso."'>
                                                                                     <input class='d-none' name='id_disciplina' value='".$id_disciplina."'>
                                                                                     <button class='floatr btn btn-outline-danger' style='font-size: 14px;'> Desvincular disciplina </button>
                                                                                     </form></li>
                                                                                   ";
            }

            ?>
        </ul>


    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>