<?php 
require_once('../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();

$sql_aviso = "select * from aviso";
$result_aviso = mysqli_query($link,$sql_aviso);

?>



<div class="painel">
    <div class="logo">Painel de recados</div>

    <?php 
    while($qr_aviso = mysqli_fetch_assoc($result_aviso)){
        $titulo = $qr_aviso['titulo'];
        $descricao = $qr_aviso['descricao'];
        $hora = $qr_aviso['hora'];

        echo "
    <div class='recado-logo'>".$titulo."</div>
    <div class='recado-body'>".$descricao."</div>
    <div class='recado-down'> - Atenciosamente, Administração Myschool, ".date('d/m/Y', strtotime($hora))."</div>
    <div>_____________________________________</div>"; }
    ?>
</div>