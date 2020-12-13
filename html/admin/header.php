<?php

//Affichage des differents header en fonction des variables de session
if (isset($_SESSION['Profil'])) {
    if ($_SESSION['Profil'] == 'Administrateur') {
        ?>
        <style>
            #header {
                border-left-width: 0 !important;
                border-bottom-width: 1px !important;
                border-top-width: 0 !important;
                border-right-width: 0 !important;
                white-space: nowrap !important;
            }
        </style>
        <header id="header" class="border border-warning">
            <div class=" w-100 text-white bg-dark ">
                <h2 class="w-45  d-inline-block">
                    <a href="../Index.php"><img src="../../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
                    - Admin
                </h2>


                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="editMarker.php" class="btn text-white bg-dark w-45">Gestion des Markers</a>
                </div>

                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="mapManager.php" class="btn text-white bg-dark">Gestion des Cartes et Dates</a>
                </div>

                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="Gestion_user.php" class="btn text-white bg-dark">Gestion des Utilisateurs</a>
                </div>

                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="Gestion_OH.php" class="btn text-white bg-dark">Gestion des Objets Historiques</a>
                </div>

                <h2 class="w-45 d-inline-block float-right">
                    <a href="" class="text-white font-weight-lighter">A propos</a>
                    <img src="../../images/autre/logo_mini.png" class="w-auto" alt="">
                    <a href="../deconnexion.php"><img src="../../images/autre/logo_mini.png" class="w-auto" alt=""></a>
                </h2>

            </div>


        </header>


        <?php
    } elseif ($_SESSION['Profil'] == 'Contributeur') {
        ?>
        <style>
            #header {
                border-left-width: 0 !important;
                border-bottom-width: 1px !important;
                border-top-width: 0 !important;
                border-right-width: 0 !important;

            }
        </style>
        <header id="header" class="border border-warning">
            <div class=" w-100 text-white bg-dark ">
                <h2 class="w-45  d-inline-block">
                    <a href="../Index.php"><img src="../../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
                    - Admin
                </h2>


                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="editMarker.php" class="btn text-white bg-dark w-45">Gestion des Markers</a>
                </div>

                <div class="pl-3 pr-3 d-inline-block w-45  bg-dark text-white">
                    <a href="Gestion_OH.php" class="btn text-white bg-dark">Gestion des Objets Historiques</a>
                </div>
                <h2 class="w-45 d-inline-block float-right">
                    <a href="" class="text-white font-weight-lighter">A propos</a>
                    <img src="../../images/autre/logo_mini.png" class="w-auto" alt="">
                    <a href="../deconnexion.php"><img src="../../images/autre/logo_mini.png" class="w-auto" alt=""></a>
                </h2>

            </div>


        </header>

        <?php
    } else {
        header("location:../Index.php");
    }
} else {

    ?>
    <header id="header" class="border border-warning">
        <div class="d-inline-block w-100 text-white bg-dark ">
            <h2 class="w-45  d-inline-block">
                <a href="../Index.php"><img src="../../images/autre/logo_mini.png" class="w-auto" alt=""></a>Immersailles
            </h2>
            <h2 class="w-45 d-inline-block float-right">
                <a href="" class="text-white font-weight-lighter">A propos</a>
                <img src="../../images/autre/logo_mini.png" class="w-auto" alt="">
                <a href="../connexion.php">
                    <img src="../../images/autre/profil.png" class="w-auto" alt="">
                </a>
            </h2>

        </div>
    </header>
    <?php
}
?>


