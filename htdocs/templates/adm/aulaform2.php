<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$idprof = $_GET['id'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql_prof = "select * from professor where id = $idprof";
$result_sql_prof = mysqli_query($link,$sql_prof);
$qr_sql_prof = mysqli_fetch_assoc($result_sql_prof);
$nome = $qr_sql_prof['nome'];


$sql = "select * from professor_disciplina where id_professor = $idprof";
$result = mysqli_query($link, $sql);



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
        <div class='container'><span class='display-6'> Selecione a disciplina que deseja cadastrar uma Aula</span>
            <div class='col-md-5'>
                <ul class='list-group mt-3'>
                    <li class='list-group-item active'>Disciplina(s) do professor(a): <?php echo "<span style='font-size: 20px'>".$nome." </span>"; ?> </li>
                    <?php
                    while ($qr = mysqli_fetch_assoc($result)) {
                        $idp = $qr['id'];
                        $idisc = $qr['id_disciplina'];
                        $sql_nome_disc = "select * from disciplina where id = $idisc";
                        $result_nome_disc = mysqli_query($link,$sql_nome_disc);
                        $qr_nome_disc = mysqli_fetch_assoc($result_nome_disc);
                        $nome_disc = $qr_nome_disc['nome'];
                        echo "<li class='list-group-item'><a class='link-none' href='http://localhost/templates/adm/aulaform3.php?idp=".$idp."&id=".$idisc."'>".$nome_disc." </a></li>";

                    }
                    ?>
                </ul>
            </div>


        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>