<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

$id = $_GET['id'];

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from curso where id = $id";
$result = mysqli_query($link, $sql);
$dateResult = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<title>Disciplina</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
        <?php 
           echo "
                <div class='container'>
                 <div class='col-md-8'>
                  <p class='display-6'>Editar </p>
                  <form class='col-md-5' action='./query/edcursobd.php' method='POST'> 
                    <input class='form-control' type='text' name='curso' value='".$dateResult['nome']."' >
                    <textarea class='form-control mt-3' name='descricao'>".$dateResult['descricao']."</textarea>
                    <input class='d-none' name='id' value='".$id."' >
                    <button class='btn btn-outline-dark mt-3'>Editar</button>
                  </form>
                 </div> 
                </div>
           
                ";
        ?>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>