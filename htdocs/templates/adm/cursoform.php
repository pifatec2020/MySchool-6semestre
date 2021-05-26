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
            <p class='display-6'>Formulário de cadastro ( curso )</p>

            <div class='col-md-6'>
                <form action="./query/cursosave.php" method="POST">
                    <input name="nome" type="text" class='form-control' placeholder="Nome do curso" required>
                    <textarea name="descricao" placeholder="Descrição do curso" cols="10" rows="4" class='form-control mt-4' required></textarea>
                    <div class='col-md-4'>
                    <input name="duracao" type="number" class='form-control mt-4'min='1' max='4' placeholder="Duração do curso/ ano" required>

                    <button type="submit" class='mt-3 btn-forms'>Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>











    <script src="./script/sidebar.js"></script>

</body>

</html>