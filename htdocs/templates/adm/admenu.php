<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}
?>

<!DOCTYPE html>
<html>
<title>Menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href='./style/menu2.css'>
<?php
include('../include/w3school.php');
include('../include/bootstrap.php');
?>


<body>
    <?php 
    include('../include/navbar.php');
    include('../include/sidebar.php')
    ?>
    

    <div class='conteudo'>
        <!-- <img class='img-full' src="./img/myschool2.jpg" alt=""> -->

    </div>








    <script src="./script/sidebar.js"></script>

</body>

</html>