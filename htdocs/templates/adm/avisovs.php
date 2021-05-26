<?php
session_start();

if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


require('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql = "select * from aviso";
$result = mysqli_query($link, $sql);

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
        <div class='container'>
            <div class='display-6'>Cadastrar Recado</div>
            <?php while($qr = mysqli_fetch_assoc($result)){  
            $titulo = $qr['titulo'];
            $descricao = $qr['descricao'];
            $id = $qr['id'];
                
            ?>
            <div class="col-md-4 mt-4">
                <form action="./query/avisoed.php" method="POST">
                    <input class="form-control" name="titulo" type="text" placeholder="Título do recado" value='<?=$titulo?>' required>
                    <input name='id' value='<?=$id?>' style="display: none;">
                    <textarea class="form-control mt-2" name="descricao" cols="30" rows="10" placeholder="Mensagem a ser visualizada no painel de recados." required><?=$descricao?></textarea>
                    <button class="mt-2 btn btn-outline-dark">Editar</button>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>











    <script src="./script/sidebar.js"></script>

</body>

</html>


