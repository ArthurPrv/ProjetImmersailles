<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
        type="text/javascript"></script>
<link href='https://fonts.googleapis.com/css?family=Exo+2:ital,wght@0,300;1,500' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="../../css/timeline/timeline.css">
<link rel="stylesheet" href="../../css/timeline/timeline_2.css">
<link rel="icon" type="image/png" href="../../images/autre/logo_mini.png"/>
<title>Récupération Mot de Passe </title>


<?php
session_start();
include("header.php");


if (isset($_POST['Mail'])) {

$_SESSION["Mail_tempo"] = $_POST["Mail"];

$date = date("Y-m-d H:i:s");
mail("" . $_SESSION["Mail_tempo"], "Recuperation de mot de passe", "" . $date . " Votre code de récuperation pour le site Immersailles est le suivant : \n\n" . $_SESSION['Code']);
?>
<body style=" background-color: rgba(255,203,72,0.25);">
<div style=" padding:10px;width: 30%; margin-left: auto ; margin-right: auto ; margin-top: 3%; border-radius: 10px; background-color: #49494A; color: white">
    <form action="" method="post" style="text-align:center !important;">


        <label for="Mail">Mail :</label> <br>
        <?php

        echo("<input size='30' type=\"text\" id=\"Mail\" name=\"Mail\" value=\"" . $_POST['Mail'] . "\" required> <br><br>")
        ?>
        <label for="Login">Login :</label> <br>
        <input type="text" id="Login" name="Login" required> <br><br>

        <label for="Code">Code de recupération :</label> <br>
        <input type="text" id="Code" name="Code" required> <br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required> <br>

        <label for="mdp2">Confirmation Mot de passe :</label><br>
        <input type="password" id="mdp2" name="mdp2" required> <br>

        <p style="padding: 10px">
            <input type="submit" name="submit" value="Envoyer">
        </p>

    </form>
</div>
<?php
if (isset($_POST['Login']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && isset($_POST['Code'])) {
    if ($_POST['Code'] == $_SESSION['Code']) {
        if ($_POST["mdp"] == $_POST["mdp2"]) {
            include('../connexion_bdd.php');
            $sql = "SELECT * FROM AUTHENTIFICATION WHERE Login='" . $_POST['Login'] . "' AND Mail='" . ($_SESSION['Mail_tempo']) . "';";
            $result = $db->query($sql);
            $nb = $result->rowCount();
            $result->closeCursor();
            if ($nb >= 1) {
                // si toutes les données sont valides, on initialise nos variables de Sessions puis on redirige l'utilisateur sur ca page d'accueil selon son role


                $sql2 = "UPDATE AUTHENTIFICATION SET Password =sha1('" . $_POST['mdp'] . "') WHERE Login='" . $_POST['Login'] . "';";

                $result = $db->exec($sql2);

                echo "mot de passe changé";


            } else {
                echo "mauvaise association login / Mail";
            }
        } else {
            echo "les deux mots de passes sont différents";
        }
    } else {
        echo 'mauvais code de recupération';
    }
}


}
?>
<div class="fixed-bottom">
    <?php

    include '../footer.php';
    ?></div>