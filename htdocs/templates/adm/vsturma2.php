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
$sql = "select * from turma where id_curso = $id_curso";
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
                Turma(s) do curso: <?php echo "<span style='font-size: 20px'> $nome_curso </span>"; ?>
            </div>
            <?php
            while ($qr_turma = mysqli_fetch_assoc($result)) {
                echo " <li class='list-group-item'>Semestre: ".$qr_turma['semestre']."</li>";
            }

            ?>
        </ul>


    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>