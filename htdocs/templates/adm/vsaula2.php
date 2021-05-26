<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id = $_GET['id'];

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
$sql = "select * from aula where id_pd = $id";
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
        <div class='col-md-4'>
            <ul class='list-group'>
                <li class='list-group-item' style="background-color: rgb(50, 187, 250); font-size:18px;">Aulas / DATA </li>
                <?php
               while($qr = mysqli_fetch_assoc($result)){
                   $id_turma = $qr['id_turma'];
                   $sql_turma = "select * from turma where id = $id_turma";
                   $result_turma = mysqli_query($link,$sql_turma);
                   $qr_turma = mysqli_fetch_assoc($result_turma);
                   $id_curso = $qr_turma['id_curso'];
                   $sql_curso = "select * from curso where id = $id_curso";
                   $result_curso = mysqli_query($link,$sql_curso);
                   $qr_curso = mysqli_fetch_assoc($result_curso);
                   $nome_curso = $qr_curso['nome'];
                   $semestre = $qr_turma['semestre'];
                    echo "<li class='list-group-item'>".$qr['data']." - ".$semestre."° Semestre (".$nome_curso.")</li>"; 
               }
                
                ?>
        </div>
        </ul>



    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>