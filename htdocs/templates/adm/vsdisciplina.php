<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql = "select * from disciplina";
$result = mysqli_query($link, $sql);
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
                                Editar disciplina
                            </th>
                        </tr>
                    </thead>
                    <tbody class='mt-2'>
                        <?php 
                          while ($qr = mysqli_fetch_assoc($result)){
                              if($qr['carga_horaria']== 80){
                              echo "
                                    <tr class='mt-3 bg-tr80'>
                                      <td class=''><span class='fontetr'>".$qr['nome']."</span></td>
                                      <td><span class='fontetrhr'>".$qr['carga_horaria']."</span></td>
                                      <td>
                                         <form action='./edisciplina.php' method='GET'>
                                            <input class='d-none' type='text' name='id' value='".$qr['id']."'>
                                            <button class='floatr btn btn-dark'>Editar</button>
                                         </form>  
                                      </td>
                                   </tr> ";}

                             if($qr['carga_horaria']== 40){
                              echo "
                                    <tr class='mt-3 bg-tr40'>
                                        <td class=''><span class='fontetr'>".$qr['nome']."</span></td>
                                        <td><span class='fontetrhr'>".$qr['carga_horaria']."</span></td>
                                        <td>
                                         <form action='./edisciplina.php' method='GET'>
                                            <input class='d-none' type='text' name='id' value='".$qr['id']."'>
                                            <button class='floatr btn btn-dark'>Editar</button>
                                         </form>  
                                      </td>
                                     </tr> ";}
                              
                          }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>