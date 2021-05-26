<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


$num = 0;
if (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    if ($mensagem == 1) {
        $num = 1;
    }
}



require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from professor";
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
        <div class='col-md-6'>
            <ul class='list-group'>
                <li class='list-group-item active'>Lista de Professores </li>
                <?php
                while ($qr_prof = mysqli_fetch_assoc($result)) {
                    echo " 
                   <li class='list-group-item'><a style='text-decoration: none;' href='http://localhost/templates/adm/vsprofessor.php?usuario=".$qr_prof['usuario']."'>" . $qr_prof['nome'] . "</a></li>
                   ";
                }
                ?>
        </div>
        </ul>



    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>