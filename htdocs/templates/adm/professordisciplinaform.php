<?php
session_start();
$num = 0;
if (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    if ($mensagem == 1) {
        $num = 1;
    }
}
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}


require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$sql_prof = "select * from professor";
$sql_disciplina = "select * from disciplina";
$result_prof = mysqli_query($link, $sql_prof);
$result_disciplina = mysqli_query($link, $sql_disciplina);
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
    include('../include/sidebar.php')
    ?>


    <div class='conteudo'>
        <div class='col-md-6 container'>
            <h1 class='display-6'>Cadastrar Professor na disciplina</h1>
            <form action='./query/professordisciplinasave.php' method='POST' class='mt-4'>
                <span style='font-size: 18px;'>Selecione o Professor:</span>
                <select class='form-control' name='id_professor' required>
                    <?php while ($qr_prof = mysqli_fetch_assoc($result_prof)) {
                        echo " <option value='" . $qr_prof['id'] . "'> " . $qr_prof['nome'] . " </option>";
                    }  ?>
                </select>
                <div class='mt-2' style='font-size: 18px'>Selecione a Disciplina:</div>
                <select class='form-control' name="id_disciplina" id="">
                    <?php while ($qr_disciplina = mysqli_fetch_assoc($result_disciplina)) {
                        echo " <option value='" . $qr_disciplina['id'] . "'> " . $qr_disciplina['nome'] . " </option>";
                    }  ?>
                </select>
                <?php if ($num == 1) {
                    echo " <span style='color: red;'> Professor já cadastrada para essa disciplina </span><br/>";
                } ?>
                <button class='btn btn-outline-dark mt-3' type="submit">Cadastrar</button>
            </form>
        </div>
    </div>











    <script src="./script/sidebar.js"></script>

</body>

</html>