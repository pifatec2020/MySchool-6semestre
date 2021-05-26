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
        <div class='container'>
            <div class='container'>
                <div class='display-6'>Cadastrar Recado</div>
                <div class="col-md-4 mt-4">
                    <form action="./query/avisosv.php" method="POST">
                        <input class="form-control" name="titulo" type="text" placeholder="Título do recado" required>
                        <textarea class="form-control mt-2" name="descricao" cols="30" rows="10" placeholder="Mensagem a ser visualizada no painel de recados." required></textarea>
                        <button class="mt-2 btn btn-outline-dark">Salvar Recado</button>
                        <div class='recados'><a href='http://localhost/templates/adm/avisovs.php' class='recados'>Visualizar recado </a></div>
                    </form>
                </div>
            </div>
        </div>











        <script src="./script/sidebar.js"></script>

</body>

</html>