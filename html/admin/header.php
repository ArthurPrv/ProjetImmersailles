<header>
    <div class="d-inline-block w-100 text-white bg-dark ">
        <h1 class="w-45  d-inline-block">
            <img src="../images/logo_mini.png" class="w-auto">Immersailles
            <?php
            echo ('<p>Bonjour, '.$_SESSION['nom']." ".$_SESSION['prenom'].'</p>');
            ?></h1>

        <h1 class="w-45 d-inline-block float-right">
            <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
            <img src="../images/logo_mini.png" class="w-auto">
            <a href="connexion.php"><img src="../images/logo_mini.png" class="w-auto"></a>
        </h1>

    </div>
</header>