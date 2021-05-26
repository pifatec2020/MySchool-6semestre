<?php
$id = $_SESSION['id_aluno'];
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$aluno_nome = $_SESSION['nome'];

$sql = "select * from aluno_turma where id_aluno = $id";
$result = mysqli_query($link, $sql);
$qr = mysqli_fetch_assoc($result);
$turma = $qr['id_turma'];

$sql_turma = "select * from turma where id= $turma";
$result_turma = mysqli_query($link, $sql_turma);
$qr_turma = mysqli_fetch_assoc($result_turma);
$curso = $qr_turma['id_curso'];
$semestre = $qr_turma['semestre'];

$sql_curso = "select * from curso where id = $curso";
$result_curso = mysqli_query($link, $sql_curso);
$qr_curso = mysqli_fetch_assoc($result_curso);
$nome = $qr_curso['nome'];

$sql_d = "select * from ds where id_turma = $turma";
$result_d = mysqli_query($link, $sql_d);
// $qr_d = mysqli_fetch_assoc($result_d);
// $pd = $qr_d['id_pd'];


?>

<link href='https://css.gg/album.css' rel='stylesheet'>
<link href='https://css.gg/list.css' rel='stylesheet'>
<link href='https://css.gg/user-list.css' rel='stylesheet'>

<div class="bg-normal col-md- painel-aluno ">
    <div class='align-img'><a href="http://localhost/templates/aluno/aluno.php"><img class='img-aluno border-img' src="../adm/query/uploads/<?php echo $img ?>" alt=""></a>
        <p style="font-size: 20px;"><?= $aluno_nome ?></p>
        <span><span style="">Cursando </span>: <?= $semestre ?>° semestre</span>
        <div class="mt-2" style="color: white;">Curso:</div>
        <p class='d-name1'><?= $nome ?></p>

        <!-- <div class='divsao'>. . . .</div> -->

        <div>
            <h6 style="color: white;">Disciplinas</h6>
            <?php
            while ($qrTurma = mysqli_fetch_assoc($result_d)) {
                $pd = $qrTurma['id_pd'];
                $sql_pd = "select * from professor_disciplina where id = $pd";
                $result_pd = mysqli_query($link, $sql_pd);
                $qr_pd = mysqli_fetch_assoc($result_pd);
                $id_d = $qr_pd['id_disciplina'];
                $sql_dd = "select * from disciplina where id = $id_d";
                $result_dd = mysqli_query($link, $sql_dd);
                $qr_dd = mysqli_fetch_assoc($result_dd);
                $nome_dd = $qr_dd['nome'];
                echo "<div class='d-name'>" . $nome_dd . "</div> ";
            }
            ?>

            <a href="http://localhost/templates/aluno/notas.php?turma=<?=$turma?>"><button class="mt-3 bt-OP"><i class="gg-album icon"></i>Notas</button></a>
            <a href="http://localhost/templates/aluno/faltas.php?turma=<?=$turma?>"><button class="mt-2 bt-OP"><i class="gg-user-list icon"></i>Presença</button></a>
            <a href='http://localhost/templates/aluno/atividade.php?turma=<?=$turma?>'><button class="mt-2 bt-OP"><i class="gg-list icon"></i>Atividades</button></a>

        </div>
    </div>
</div>