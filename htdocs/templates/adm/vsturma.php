<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from curso";
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
            <div class="list-group-item list-group-item-action active bg-dark">
                Curso:
            </div>
            <?php 
              while ($qr = mysqli_fetch_assoc($result)){
                  echo "
                          <li class='list-group-item'><a href='./vsturma2.php?id=".$qr['id']."&nome=".$qr['nome']."' class='link-none'
                          style='color: rgb(188, 110, 240);'>".$qr['nome']."</a> </li>
                       ";
              }
            ?>
        </ul>





    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>