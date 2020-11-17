<?php
session_start();

?>


<?php
if (isset($_SESSION['Profil'])) {
    if ($_SESSION['Profil'] == 'Administrateur') {


        ?>
        <header>
            <div class=" w-100 text-white bg-dark ">
                <h2 class="w-45  d-inline-block">
                    <a href="Index.php"><img src="../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
                    - Admin</h2>


                <div class="m-lg-5 d-inline-block w-45  bg-dark text-white">
                    <a href="admin/editMarker.php" class="btn text-white bg-dark w-45">Gestion des Markers</a>
                </div>

                <div class="m-lg-5 d-inline-block w-45  bg-dark text-white">
                    <a href="#" class="btn text-white bg-dark">Gestion des Cartes et Dates</a>
                </div>

                <div class="m-lg-5 d-inline-block w-45  bg-dark text-white">
                    <a href="admin/Gestion_user.php" class="btn text-white bg-dark">Gestion des Utilisateurs</a>
                </div>


                <h2 class="w-45 d-inline-block float-right">
                    <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
                    <img src="../images/autre/logo_mini.png" class="w-auto" alt="">
                    <a href="deconnexion.php"><img src="../images/autre/logo_mini.png" class="w-auto" alt=""></a>
                </h2>

            </div>


        </header>


        <?php
    } else if ($_SESSION['Profil'] == 'Contributeur') {
        ?>
        <header>
            <div class="d-inline-block w-100 text-white bg-dark ">
                <h2 class="w-45  d-inline-block">
                    <a href="Index.php"><img src="../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
                    -
                    Contributeur</h2>
                <h2 class="w-45 d-inline-block float-right">
                    <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
                    <img src="../images/autre/logo_mini.png" class="w-auto" alt="">
                    <a href="deconnexion.php"><img src="../images/autre/logo_mini.png" class="w-auto" alt=""></a>
                </h2>

            </div>
        </header>
        <?php
    }
}
else{
    ?>
    <header>
        <div class="d-inline-block w-100 text-white bg-dark ">
            <h2 class="w-45  d-inline-block">
                <a href="Index.php"><img src="../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
            </h2>
            <h2 class="w-45 d-inline-block float-right">
                <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
                <img src="../images/autre/logo_mini.png" class="w-auto" alt="">
                <a href="connexion.php">
                    <img src="../images/autre/profil.png" class="w-auto" alt="">
                </a>
            </h2>

        </div>
    </header>
    <?php
}
?>
