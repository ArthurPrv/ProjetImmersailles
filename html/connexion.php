<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion</title>


    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="../css/timeline/timeline.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
            type="text/javascript"></script>

    <link href='https://fonts.googleapis.com/css?family=Exo+2:ital,wght@0,300;1,500' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="../css/timeline/timeline.css">
    <link rel="stylesheet" href="../css/timeline/timeline_2.css">

    <link rel="icon" type="image/png" href="../images/autre/logo_mini.png"/>
</head>
<?php
include("header.php");
?>
<body style=" background-color: rgba(255,203,72,0.25);">

<div style=" padding:10px;width: 30%; margin-left: auto ; margin-right: auto ; margin-top: 3%; border-radius: 10px; background-color: #49494A; color: white;text-align: center !important;">
    <h2>Connexion</h2>
    <form class="align-content-center" action="" method="post">

        <label for="Login">Login :</label> <br>
        <input type="text" id="Login" name="Login" required> <br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required> <br>


        <p style="padding: 10px">
            <input type="submit" name="submit" value="Envoyer">
        </p>


    </form>
    <a href="admin/recup_mdp.php">Mot de passe oublié</a>


    <?php
    //on vérifie si l'utilisateur a bien rentré les informations sinon on lui dit qu'il n'as pas rempli les champs

    if (isset($_POST['Login']) && isset($_POST['mdp'])) {
        if (empty($_POST['Login'])) {
            echo "<p class='erreur'>Login non renseigné dans le formulaire !</p>\n";
        } else if (empty($_POST['mdp'])) {
            echo "<p class='erreur'>Mot de passe non renseigné dans le formulaire !</p>\n";
        } else {
            include('connexion_bdd.php');
            //requete permettant de savoir si les données se trouvent bien dans la base de données
            $sql = "SELECT * FROM AUTHENTIFICATION WHERE Login='" . $_POST['Login'] . "' AND Password='" . sha1($_POST['mdp']) . "';";
            $result = $db->query($sql);
            $nb = $result->rowCount();
            $result->closeCursor();
            if ($nb >= 1) {
                // si oui on initialise nos variables de Sessions puis on redirige l'utilisateur sur ca page d'accueil selon son role


                $sql = "SELECT  ID_User,Login,Profil FROM AUTHENTIFICATION WHERE Login='" . $_POST['Login'] . "';";
                $result = $db->query($sql);
                $ligne = $result->fetch();
                $sql2 = "INSERT INTO SESSIONS (Datetime,ID_User) VALUES ('" . date("Y-m-d H:i:s") . "','" . $ligne['ID_User'] . "');";

                $results = $db->exec($sql2);
                $_SESSION['Login'] = $_POST['Login'];
                $_SESSION['Profil'] = $ligne['Profil'];


                header('location:Index.php');

            } else {
                // s'il n'arrive pas a se connecter on lui dit si son mot de passe est incorrect ou si il s'agit de son id d'utilisateur
                $sql = "SELECT * FROM AUTHENTIFICATION WHERE Login='" . $_POST['Login'] . "';";
                $resultat = $db->query($sql);
                $nb = $resultat->rowCount();
                $resultat->closeCursor();
                if ($nb >= 1) {
                    echo "<p class='erreur'>Mot de passe incorrect.</p>\n";
                } else {
                    echo "<p class='erreur'>Login inconnu dans notre base de données.</p>\n";
                }
            }
        }

    }


    ?></div>
</body>
<div class="fixed-bottom">
    <?php

    include 'footer.php';
    ?></div>
</html>