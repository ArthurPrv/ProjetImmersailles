<?php
include("header.php");


if (isset($_POST['Mail'])) {

    $_SESSION["Mail_tempo"] = $_POST["Mail"];

    $date = date("Y-m-d H:i:s");
    mail("" . $_SESSION["Mail_tempo"], "Recuperation de mot de passe", "" . $date . " Votre code de récuperation pour le site Immersailles est le suivant : \n\n" . $_SESSION['Code']);
    ?>
    <form action="" method="post">


        <label for="Mail">Mail :</label> <br>
        <?php

        echo("<input type=\"text\" id=\"Mail\" name=\"Mail\" value=\"" . $_POST['Mail'] . "\" required> <br><br>")
        ?>
        <label for="Login">Login :</label> <br>
        <input type="text" id="Login" name="Login" required> <br><br>

        <label for="Code">Code de recupération :</label> <br>
        <input type="text" id="Code" name="Code" required> <br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required> <br>

        <label for="mdp2">Confirmation Mot de passe :</label><br>
        <input type="password" id="mdp2" name="mdp2" required> <br>

        <input type="reset" name="reset" value="Annulez">
        <input type="submit" name="submit" value="Envoyer">


    </form>

    <?php
    if (isset($_POST['Login']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && isset($_POST['Code'])) {
        if ($_POST['Code'] == $_SESSION['Code']) {
            if ($_POST["mdp"] == $_POST["mdp2"]) {
                include('connexion_bdd.php');
                $sql = "SELECT * FROM AUTHENTIFICATION WHERE Login='" . $_POST['Login'] . "' AND Mail='" . ($_SESSION['Mail_tempo']) . "';";
                $result = $db->query($sql);
                $nb = $result->rowCount();
                $result->closeCursor();
                if ($nb >= 1) {
                    // si oui on initialise nos variables de Sessions puis on redirige l'utilisateur sur ca page d'accueil selon son role


                    $sql2 = "UPDATE AUTHENTIFICATION SET Password =sha1('" . $_POST['mdp'] . "') WHERE Login='" . $_POST['Login'] . "';";

                    $result = $db->exec($sql2);

                    echo "mot de passe changé";


                } else {
                    echo "mauvaise association login / Mail";
                }
            } else {
                echo "les deux mots de passes ne sont pas égaux";
            }
        } else {
            echo 'mauvais code de recup';
        }
    } else {
        echo 'coucou';
    }


} else {
    echo "couc";
}