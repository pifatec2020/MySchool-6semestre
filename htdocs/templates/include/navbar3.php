<?php
$user = $_SESSION['user'];
?>

<style>
    .icon{
    height: 30px;
    margin-top: 3px; 
    }

    .background{
        background-color: rgb(100, 100, 220);
        transition-property: background-color;
        transition-duration: 0.5s;
    }

    .background:hover{
        background-color: rgb(50, 100, 220);
    }

</style>
<nav class="navbar navbar-expand-md background navbar-dark" style="position:float;">

    <div class="navbar-brand ms-3"> <a href="http://localhost/templates/aluno/aluno.php" style="text-decoration: none; color: White"> Myschool</a></div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbar" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav me-2">
            
            <div><img class='icon' src="../adm/img/icon/user.png" alt=""></div>
            <li class="nav-item"><a class="nav-link" href=""><?= $user?></a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost/script/sair.php">Sair</a></li>
        </ul>
    </div>

</nav>