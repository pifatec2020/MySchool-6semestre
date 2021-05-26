<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

require_once('../../dbCoonection.php');
                $objDb = new db();
                $link = $objDb->connection_mysql();


$aula = true;
if(isset($_GET['idp'])){
    $idp = $_GET['idp'];
    $sqlidprof = "select * from professor where id = $idp";
    $resultado = mysqli_query($link,$sqlidprof);
    $qresultado = mysqli_fetch_assoc($resultado);
    $aula = false;
    $aulamsg = "Não foi possivel desvincular a disciplina, motivo: <br/>  Disciplina está cadastrada em uma aula";
    
}

$num = 0;
if (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    if ($mensagem == 1) {
        $num = 1;
    }
}
$MSG = 0;

?>
<!DOCTYPE html>
<html>
<title>Curso</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href='./style/disciplinaform.css'>
<link rel="stylesheet" href='./style/menu2.css'>
<link rel="stylesheet" href='./style/professor.css'>
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
        <div class='forme'>

            <div class='col-md-6'>
                <form action="" action="GET">
                    <div> Pesquise o professor pelo usuario:</div>
                    <input class='professor' name="usuario" type="text" id="txtBusca" placeholder="Pesquisar professor" />
                    <button class='botao'>Buscar</button>
                </form>
            </div>

            <?php if(!$aula){
                echo "<span style='color: red;'> $aulamsg </span>";
            } ?>


            <?php
            if (isset($_GET['usuario'])) {
                $usuario = $_GET['usuario'];
                $sql = "select * from professor where usuario = '$usuario'";
                $result = mysqli_query($link, $sql);
                $qr_professor = mysqli_fetch_assoc($result);
                if (!$qr_professor) {
                    echo "<span style='color: red;'> usuario não encontrado </span>";
                }
            }

            if (isset($qr_professor['usuario'])) {
                $cpf = $qr_professor['cpf'];
                $sql_find = "select * from upload_img where id_user = $cpf";
                $result = mysqli_query($link, $sql_find);
                $nome_arquivo = mysqli_fetch_assoc($result);
                $img = $nome_arquivo['arquivo'];
                $idprof = $qr_professor['id'];
                $sql_disciplina = "select * from professor_disciplina where id_professor = $idprof";
                if ($result_dp = mysqli_query($link, $sql_disciplina)) {
                    $MSG = TRUE;
                }

                echo " 
                      <div class='card mt-3' style='width: 18rem;'>
                         <img src='http://localhost/templates/adm/query/uploads/" . $img . "' class='card-img-top' alt='...'>
                         <div class='card-body'>
                          <h5 class='card-title'>" . $qr_professor['usuario'] . "</h5>
                          <p class='card-text'><span style='font-size:16px;'>Nome:</span> " . $qr_professor['nome'] . " <br/> <span style='font-size:16px;'>E-mail:</span> " . $qr_professor['email'] . "</p>
                          <form action='./edprofessor.php' method='GET'> 
                            <input class='d-none' value='" . $qr_professor['id'] . "' name='id_professor'>
                            <button class='btn btn-outline-dark'> Editar </button>
                          </form>
                         </div>
                      </div>
                     
                     ";
            }


            ?>
            <?php if ($MSG) { ?>
                <div style="width: 18rem;">
                    <ul class='list-group'>
                        <li class='list-group-item active' style="font-size: 16.9px;">Disciplinas:</li>
                    <?php

                    while ($qr_dp = mysqli_fetch_assoc($result_dp)) {
                        $idisc = $qr_dp['id_disciplina'];
                        $sql_disc_nome = "select * from disciplina where id = $idisc";
                        $sql_result_disc = mysqli_query($link, $sql_disc_nome);
                        $qr_disc_nome = mysqli_fetch_assoc($sql_result_disc);
                        $nomeprof = $qr_professor['nome'];
                        $nome_disc = $qr_disc_nome['nome'];
                        echo "<li class='list-group-item'> $nome_disc
                         <button style='float: right;' class='btn btn-outline-danger'>
                         <a class='btn-desvincular' href='http://localhost/templates/adm/query/desvprofessordisc.php?id=$idisc&id_professor=$idprof&nome=$nomeprof'> Desvincular </a>
                         </button> </li>";
                    }
                }
                    ?>
                    </ul>
                </div>

        </div>

    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>