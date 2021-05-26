<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$id = $_GET['id'];
$sql = "select * from disciplina where id = $id";
$result = mysqli_query($link, $sql);
$qr = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<title>Disciplina</title>
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
        <div class="container">
            <div class='col-md-12'>
                <table class="table table-borderless table-hover table-sm table-striped">
                    <thead>
                        <tr>
                            <th class="">
                                Disciplina
                            </th>
                            <th>
                                Carga horaria
                            </th>
                            <th class='floatr'>
                                Salvar disciplina
                            </th>
                        </tr>
                    </thead>
                    <tbody class='mt-2'>
                       <tr class='bg-tredit'>
                           <?php 
                              echo "
                                     <form action='./query/edisciplinabd.php' method='POST'>
                                      <td><input name='nome' class='form-control' type='text' value='".$qr['nome']."'></td>
                                      <td><input name='hora' class='form-control' type='text' value='".$qr['carga_horaria']."'></td>
                                      <td><button class='btn btn-outline-primary floatr'>Salvar</button></td>
                                      <input name='id' value='".$qr['id']."' class='d-none' type='text'>
                                     </form>
                                   ";
                           
                           ?>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>