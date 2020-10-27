<?php
include("header.php");
include '../connexion_bdd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion utilisateurs</title>
</head>
<body>

<?php
if (isset($_POST['action'])) {

    ?>
    <div>
    <form action="" method="post">
    <?php


//AJOUTER UN USER
    if ($_POST['action'] == 'add') {
        if (!($_POST['action'] == 'add' && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']) && isset($_POST["mdp"]))) {
            //formulaire pour permettre de rentrer les données d'unh nouveau utilisateur
            echo "<h2>Ajout utilisateur</h2>";
            echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');
            echo '<p>Vous allez ajouter un nouvel utilisateur à la base de données : </p>';
            ?>
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
            <p>

                <input type="submit" value="VALIDER" class="button">
            </p>
            </form>
            <?php
        }
        if ($_POST['action'] == 'add' && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']) && isset($_POST["mdp"])) {
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

    } //MODIFICATION USER
    elseif ($_POST['action'] == 'modify') {
        if (!isset($_POST['ID'])) {
            ?>
            <h2>Modifier employé</h2>


            <form action="" method="post">


                <?php
                echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');

                //requete permettant d'afficher tous les employés de la plateforme sous la forme d'un tableau

                $results = $db->query("SELECT ID_User, Login, Profil, Mail FROM AUTHENTIFICATION;");
                echo '<table>';
                echo '<tr><th></th><th>Numéro Utilisateur</th><th>Login</th><th>Role</th><th>Mail</th></tr>';
                while ($ligne = $results->fetch()) {

                    echo '<tr><td><input type="radio" name="ID" value="' . $ligne['ID_User'] . '"></td><td>' . $ligne['ID_User'] . '</td><td>' . $ligne['Login'] . '</td><td>' . $ligne['Profil'] . '</td><td>' . $ligne['Mail'] . '</td></tr>';
                }
                echo '</table>';


                ?>

                <p>
                    <input type="reset" value="Retour" class="button">
                    <input type="submit" value="VALIDER" class="button">
                </p>
            </form>
            </div>
            <?php
        }
        if (isset($_POST['ID'])) {
            if (!($_POST['action'] == 'modify' && isset($_POST["ID"]) && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail']))) {

                echo('<div><form action="" method="post">');
                echo('<input type=hidden name=ID value=' . $_POST['ID'] . '> ');
                echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');
                $results = $db->query("SELECT ID_User, Login, Profil, Mail , Password FROM AUTHENTIFICATION WHERE ID_User = " . $_POST['ID'] . ";");
                $ligne = $results->fetch();
                echo '<p id="ind">Vous allez modifier un utilisateur dans la base de données : </p>';

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


                echo "<input type=\"submit\"  value=\"VALIDER\" class=\"button\"></p>";


                ?>
                </form>
                </div>


                <!-- requête permettant de mettre à jour les données sur un utilisateur qu'un administrateur à rentrer et
                s'il modifie ces données il sera déconnecté de la page pour que les modifications se mettent à jour sur les pages -->

                <?php
            }
            if ($_POST['action'] == 'modify' && isset($_POST["ID"]) && isset($_POST['Login']) && isset($_POST['Profil']) && isset($_POST['mail'])) {
                if ($_POST['Login'] != '' && $_POST['mail'] != '') {
                    $results = $db->exec("UPDATE AUTHENTIFICATION SET Login ='" . $_POST['Login'] . "', Profil = '" . $_POST['Profil'] . "', Mail = '" . $_POST['mail'] . "' WHERE ID_User = " . $_POST['ID'] . ";");
                    echo '<p>Les modifications ont bien été effectué</p>';


                }
            }
            ?>

            <?php

        }


    } // CONSULTATION DES CONNEXIONS
    elseif ($_POST['action'] == 'consult') {
        echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');
        ?>
        <div id="choix">
            <h2>Selection Utilisateur</h2>
            <form action="" method="post">

                <div id="centre">
                    <label>Liste des utilisateurs: </label><br>
                    <?php

                    echo '<select name="ID">';

                    echo('<option value="all" selected="selected">Tous</option>');
                    $results = $db->query("SELECT ID_User, Login, Profil FROM AUTHENTIFICATION;");

                    while ($ligne = $results->fetch()) {
                        echo('<option value=' . $ligne['ID_User'] . '  >' . $ligne['Login'] . ' --> ' . $ligne['Profil'] . '</option>');

                    }
                    $results->closeCursor();
                    echo '</select>';

                    ?>


                </div>
                <p>

                    <input type="submit" value="Envoyez" class="button">
                </p>
            </form>
        </div>

        <?php
        if (isset($_POST['ID'])) {
            //Affichage de toutes les données de sessions ou d'un utilisateur en particulier

            if ($_POST['ID'] == 'all') {

                $count = 0;
                echo "<table>";
                echo '<tr><th>ID</th><th>Login</th><th>Date de connexion</th></tr>';

                $results3 = $db->query("SELECT Datetime, ID_User from SESSIONS ;");
                while ($ligne3 = $results3->fetch()) {

                    $results2 = $db->query("SELECT ID_User, Login from AUTHENTIFICATION WHERE ID_User =" . $ligne3['ID_User'] . ';');
                    while ($ligne2 = $results2->fetch()) {
                        echo '<tr><td>' . $ligne2['ID_User'] . '</td>';
                        echo '<td>' . $ligne2['Login'] . '</td>';

                        echo '<td>' . $ligne3['Datetime'] . '</td></tr>';
                        $count++;
                    }


                }
                echo "\n\n il y a " . $count . " sessions dans la base de données";
            } else {
                $count = 0;
                echo "<table>";
                echo '<tr><th>ID</th><th>Login</th><th>Date de connexion</th></tr>';

                $results3 = $db->query("SELECT Datetime, ID_User from SESSIONS WHERE ID_User =" . $_POST['ID'] . ';');
                while ($ligne3 = $results3->fetch()) {

                    $results2 = $db->query("SELECT ID_User, Login, Profil from AUTHENTIFICATION WHERE ID_User =" . $_POST['ID'] . ';');
                    $ligne2 = $results2->fetch();
                    echo '<tr><td>' . $ligne2['ID_User'] . '</td>';
                    echo '<td>' . $ligne2['Login'] . '</td>';

                    echo '<td>' . $ligne3['Datetime'] . '</td></tr>';
                    $count++;


                }
                echo "\n\n il y a<b> " . $count . " </b>sessions dans la base de données pour l'utilisateur<b> " . $ligne2["Login"] . "</b> qui est " . $ligne2["Profil"];
            }


        }
        ?>
    <?php }

} //CHOIX DE BASE
else {
    ?>
    <div id="gestion_employes">
        <h2>Gestion des utilisateurs</h2>

        <form action="" method="post">
            <div id="centre">
                <?php
                //Demande à l'administrateur s'il veut ajouter ou modifier les données d'un utilisateur
                echo '<input type="radio" name="action" value="add" checked="checked"> Ajouter un utilisateur<br>';
                echo '<input type="radio" name="action" value="modify" > Mettre à jour les données d\'un utilisateur<br>';
                echo '<input type="radio" name="action" value="consult" > Suivi des connexions<br>';
                ?>
            </div>
            <p>
                <input type="submit" value="Valider" class="button">
            </p>
        </form>
    </div>
<?php } ?>
</body>