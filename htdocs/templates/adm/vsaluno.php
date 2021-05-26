<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['type'] != 'm') {
    header('Location: http://localhost/?error=1');
}

require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();


$num = 0;
if (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    if ($mensagem == 1) {
        $num = 1;
    }
}
$sm = false;
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
                    <div> Pesquise o aluno pelo usuario:</div>
                    <input class='professor' name="usuario" type="text" id="txtBusca" placeholder="Pesquisar aluno" />
                    <button class='botao'>Buscar</button>
                </form>
            </div>

            <?php
            if (isset($_GET['usuario'])) {
                $usuario = $_GET['usuario'];
                $sql = "select * from aluno where usuario = '$usuario'";
                $result = mysqli_query($link, $sql);
                $qr_aluno = mysqli_fetch_assoc($result);
                if (!$qr_aluno) {
                    echo "<span style='color: red;'> usuario não encontrado </span>";
                }
            }

            if (isset($qr_aluno['usuario'])) {
                $id_aluno = $qr_aluno['id'];
                $cpf = $qr_aluno['cpf'];
                $sql_find = "select * from upload_img where id_user = $cpf";
                $result = mysqli_query($link, $sql_find);
                $nome_arquivo = mysqli_fetch_assoc($result);
                $img = $nome_arquivo['arquivo'];
                $idaluno = $qr_aluno['id'];


                $sql_aluno_semestre = "select * from aluno_turma where id_aluno = $idaluno";
                $aluno_turma = mysqli_query($link,$sql_aluno_semestre);
                $qr_aluno_semestre = mysqli_fetch_assoc($aluno_turma);
                if($qr_aluno_semestre != NULL){
                    $id_turma = $qr_aluno_semestre['id_turma'];
                    $turma = "select * from turma where id = $id_turma";
                    $turma_result = mysqli_query($link,$turma);
                    $qr_turma = mysqli_fetch_assoc($turma_result);
                    $semestre = $qr_turma['semestre'];
                    $id_curso = $qr_turma['id_curso'];
                    $curso = "select * from curso where id =  $id_curso";
                    $curso_result = mysqli_query($link,$curso);
                    $qr_curso = mysqli_fetch_assoc($curso_result);
                    $nome_curso = $qr_curso['nome'];

                    $sm = true;

                }else {}

                echo " 
                      <div class='card mt-3' style='width: 18rem;'>
                         <img  src='http://localhost/templates/adm/query/uploads/" . $img . "' class='card-img-top' alt='...'>
                         <div class='card-body'>
                          <h5 class='card-title'>" . $qr_aluno['usuario'] . "</h5>
                          <p class='card-text'><span style='font-size:16px;'>Nome:</span> " . $qr_aluno['nome'] . " <br/> <span style='font-size:16px;'>E-mail:</span> " . $qr_aluno['email'] . "</p>
                          <form action='' method='GET'> 
                            <input class='d-none' value='" . $qr_aluno['id'] . "' name='id_aluno'>
                            <button class='btn btn-outline-dark d-none'> Editar </button>
                          </form>
                         </div>
                      </div>
                      
                     ";
            }


            ?>
            <?php if($sm){
                echo "
                      <div style='width: 270px'>
                         <ul class='list-group'>
                            <li class='list-group-item active'> Semestre: </li>
                            <li class='list-group-item'>".$semestre."° semestre - ".$nome_curso." </li>
                            <button style = 'border-radius: 4px; background-color: orange; color: White; font-size: 16px;'> 
                                <a style='text-decoration: none;color: white;' href='http://localhost/templates/adm/edsemestre.php?id=$id_aluno'> Editar semestre </a>
                            </button>
                        </ul>
                     </div> "; }
            ?>

        </div>

    </div>







    <script src="./script/sidebar.js"></script>

</body>

</html>