<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from professor";
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
        <div class='display-6'>Cadastrar Aula</div>
        <div class='container'>Selecione o professor que deseja cadastrar uma Aula
            <div class='col-md-4'>
                <ul class='list-group mt-3'>
                    <?php 
                      while($qr = mysqli_fetch_assoc($result)){
                          echo "<li class='list-group-item'><a class='link-none' href='http://localhost/templates/adm/aulaform2.php?id=".$qr['id']."'>".$qr['nome']."</a></li>";
                      }
                    ?>
                </ul>
            </div>


        </div>


    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>