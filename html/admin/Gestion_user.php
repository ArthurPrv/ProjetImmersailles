<?php
session_start();
if (!isset($_SESSION['Profil'])) {
    header('location:../Index.php');
} elseif ($_SESSION['Profil'] != 'Administrateur') {
    header("location:../Index.php");
}


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <title>GestionUser</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
            type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="../../DataTables/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="../../DataTables/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../DataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../js/DataTable.js"></script>
    <script type="text/javascript" src="../../DataTables/dataTables.bootstrap4.min.js"></script>


    <link rel="icon" type="image/png" href="../../images/autre/logo_mini.png"/>


</head>
<?php
include("header.php");
include '../connexion_bdd.php';
?>
<body>

<div class="d-block  border-bottom border-dark ">

    <div class="ml-3 d-inline-flex pr-3 border-right border-dark pb-3" style="width: 48%">
        <div style=" width: 100%; margin:3% 30% 3% 30% ;  border-radius: 10px; background-color: #49494A; color: white">
            <form action="" method="post" style="text-align:center !important;">

                <h2 style="text-align:center">Ajout utilisateur</h2>
                <p style="text-align: center">Vous allez ajouter un nouvel utilisateur à la base de données : </p>

                <br>


                <label>Login : </label><br>
                <input type="text" name="Login"><br>

                <label>Profil : </label><br>
                <select name="Profil">
                    <option value="Administrateur">Administrateur</option>
                    <option value="Contributeur">Contributeur</option>

                </select><br>

                <label>Adresse mail : </label><br>
                <input type="text" name="mail"><br>

                <label>Mot de passe : </label><br>
                <input type="text" name="mdp"><br>

                <p class="py-2">
                    <input type="submit" value="VALIDER" class="button">
                </p>

            </form>
            <?php


            if (isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']) && isset($_POST["mdp"])) {
                if ($_POST['Login'] != '' && $_POST['mail'] != '' && $_POST['mdp'] != '') {
                    //permet d'avoir un nouveau id en fonction du role pour un nouveau utilisateur
                    $requete = 'SELECT MAX(ID_User)+1 id_use FROM AUTHENTIFICATION ;';
                    $results = $db->query($requete);
                    $ligne = ($results->fetch());
                    $ID = $ligne['id_use'];

                    //Ajout d'un nouveau utilisateur dans la base de donnée et affiche un message pour informer l'administrateur
                    echo '<p>Ajout d\'un utilisateur : ' . $_POST['Login'] . ' Son matricule est ' . $ID . '</p>';
                    $results2 = $db->exec('INSERT INTO AUTHENTIFICATION VALUES (' . $ID . ',"' . $_POST['Login'] . '",sha1("' . $_POST['mdp'] . '"),"' . $_POST['Profil'] . '","' . $_POST['mail'] . '");');
                }
            }


            ?>
        </div>
    </div>

    <div class="d-inline-flex pl-3 pb-3" style="width:50%">
        <?php
        if ((!isset($_POST['ID'])) || (isset($_POST["ID"]) && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']))) { ?>


        <div style="width: 100%"><h2 style="text-align: center">Modifier employé</h2>
            <p style="text-align: center" id="ind">Choisissez un utilisateur à modifier: </p>

            <form action="" method="post">


                <?php


                //requete permettant d'afficher tous les employés de la plateforme sous la forme d'un tableau

                $results = $db->query("SELECT ID_User, Login, Profil, Mail FROM AUTHENTIFICATION;");
                echo '<table class="table100-head"><thead><tr ><th></th><th>Numéro Utilisateur</th><th>Login</th><th>Role</th><th>Mail</th></tr></thead>';
                while ($ligne = $results->fetch()) {

                    echo '<tr><td><input type="radio" name="ID" value="' . $ligne['ID_User'] . '"></td><td>' . $ligne['ID_User'] . '</td><td>' . $ligne['Login'] . '</td><td>' . $ligne['Profil'] . '</td><td>' . $ligne['Mail'] . '</td></tr>';
                }
                echo '</table>';


                ?>

                <p class="text-center py-2">
                    <input type="reset" value="Retour" class="button">
                    <input type="submit" value="VALIDER" class="button">
                </p>
            </form>
            <?php
            if (!isset($_POST["ID"])) {
                echo " </div>";
            }


            }
            if (isset($_POST['ID'])) {
            if (!(isset($_POST["ID"]) && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']))) {

            echo('<div style=" width: 100%; margin:3% 30% 3% 30% ;  border-radius: 10px; background-color: #49494A; color: white; text-align: center !important;"> <h2 style="text-align: center">Modifier employé</h2><form action="" method="post">');
            echo('<input type=hidden name=ID value=' . $_POST['ID'] . '> ');

            $results = $db->query("SELECT ID_User, Login, Profil, Mail , Password FROM AUTHENTIFICATION WHERE ID_User = " . $_POST['ID'] . ";");
            $ligne = $results->fetch();
            echo '<p style="text-align: center" id="ind">Vous allez modifier un utilisateur dans la base de données : </p>';

            echo "<br>";
            echo "<p>ID : " . $_POST['ID'] . '</p>';
            echo "<label>Login : </label><br>";
            echo "<input type=\"text\" name=\"Login\" value='" . $ligne['Login'] . "'><br>";


            echo "<label>Profil : </label><br>";
            echo "<select name=\"Profil\">";
            if ($ligne['Profil'] == 'Administrateur') {
                echo "<option selected='selected'  value=\"Administrateur\">Administrateur</option>";
                echo "<option value=\"Contributeur\">Contributeur</option>";
            } else {
                echo "<option   value=\"Administrateur\">Administrateur</option>";
                echo "<option selected ='selected' value=\"Contributeur\">Contributeur</option>";
            }

            echo " </select><br>";
            echo "<label>Adresse mail : </label><br>";
            echo "<input type=\"text\" name=\"mail\" value='" . $ligne['Mail'] . "'><br>";

            ?>

            <p class="py-2">
                <input type=submit value=VALIDER class=button>
            </p>

            </form></div>
    <?php
    }
    if (isset($_POST["ID"]) && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail'])) {

        if ($_POST['Login'] != '' && $_POST['mail'] != '') {
            $results = $db->exec("UPDATE AUTHENTIFICATION SET Login ='" . $_POST['Login'] . "', Profil = '" . $_POST['Profil'] . "', Mail = '" . $_POST['mail'] . "' WHERE ID_User = " . $_POST['ID'] . ";");
            echo '<p>Les modifications ont bien été effectuées</p></div>';


        }
    }


    } ?>
    </div>

</div>


<div class='d-block ml-2 mr-4 pt-3' style=' margin-bottom: 1%'><h2 style="text-align: center">Suivi des connexions</h2>
    <table id='dataTable' class='table table-striped table-bordered m-5' style='width:90%'>
        <thead style="color: white !important;">
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Date de connexion</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // CONSULTATION DES CONNEXIONS

        {


            $results3 = $db->query("SELECT Datetime, ID_User from SESSIONS ;");
            while ($ligne3 = $results3->fetch()) {

                $results2 = $db->query("SELECT ID_User, Login from AUTHENTIFICATION WHERE ID_User =" . $ligne3['ID_User'] . ';');
                while ($ligne2 = $results2->fetch()) {
                    echo '<tr><td>' . $ligne2['ID_User'] . '</td>';
                    echo '<td>' . $ligne2['Login'] . '</td>';

                    echo '<td>' . $ligne3['Datetime'] . '</td></tr>';

                }


            }
            echo "</tbody></table></div>";
            ?>
            <div class="">
            <?php

            include '../footer.php';
            ?></div><?php }


        ?>

</body>
</html>