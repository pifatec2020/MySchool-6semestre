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
$sql = "select * from professor_disciplina";
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
                <li class='list-group-item' style="background-color: paleturquoise; font-size:18px;">Aulas do Professor(a)/Disciplina </li>
                <?php
                while ($qr = mysqli_fetch_assoc($result)) {
                    $id_professor = $qr['id_professor'];
                    $id_disc = $qr['id_disciplina'];

                    // nome professor
                    $nome = "select * from professor where id = $id_professor";
                    $result_nome = mysqli_query($link,$nome);
                    $qr_nome = mysqli_fetch_assoc($result_nome);
                    $nomep = $qr_nome['nome'];

                    //nome disciplina
                    $nomed = "select * from disciplina where id = $id_disc";
                    $resultd_nome = mysqli_query($link,$nomed);
                    $qrd_nome = mysqli_fetch_assoc($resultd_nome);
                    $nomedisc = $qrd_nome['nome'];
                    
                    
                    echo " 
                   <li class='list-group-item eli'><a style='text-decoration: none; color: rgb(125, 166, 243);' href='http://localhost/templates/adm/vsaula2.php?id=".$qr['id']."'>".$nomep." - ".$nomedisc." </a></li>
                   ";
                }
                ?>
        </div>
        </ul>



    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>