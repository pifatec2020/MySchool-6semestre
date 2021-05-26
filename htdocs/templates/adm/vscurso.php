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
        <?php $i = 0;
        while ($qr = mysqli_fetch_assoc($result)) {
            $i++;
            $nome = $qr['nome'];
            $descricao = $qr['descricao'];

            echo "
              <div id='accordion' class='col-md-12'> 
                 <div class='card'> 
                    <div class='card-header' style='background-color: rgb(159, 187, 243); color: white;'> 
                      <p type='submit' href='' class='card-link h4' data-bs-toggle='collapse' data-bs-target='#accordion" . $i . "'>
                         " . $nome . " <form style='display: inline; float: right;' action='edcurso.php' method='GET'> 
                                         <input class='d-none' name='id' value='".$qr['id']."'>
                                         <button class='btn btn-dark'> Editar </button>
                                       </form>
                      </p>
                

                        <div id='accordion".$i."' class='collapse' data-bs-parent='#accordion'>
                          <div class='card-body bg-light' style='color: black; border-radius: 10px;'>
                             ". $descricao ."
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
    
              
             ";
        } ?>
    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>