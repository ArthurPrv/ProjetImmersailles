
<?php
include ("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion </title>
</head>
<body>
<div><h1>Administration</h1>
    <form action="" method="post">

        <label for="Login">Login :</label> <br>
        <input type="text" id="Login" name="Login"  required> <br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp"  required> <br>

        <input type="reset" name="reset" value="Annulez">
        <input type="submit" name="submit" value="Envoyer">
    </form>


    <?php
    //on vérifie si l'utilisateur a bien rentrer les informations sinon on lui dit qu'il n'as pas rempli les champs

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
                $ligne = $result->fetch() ;
                    $sql2 = "INSERT INTO SESSIONS (Datetime,ID_User) VALUES ('".date("Y-m-d H:i:s")."','".$ligne['ID_User']."');";

                    $results = $db->exec($sql2);
                    $_SESSION['Login'] = $_POST['Login'];
                    $_SESSION['Profil'] = $ligne['Profil'];


               header('location:Index.php');

            } else {
                // s'il n'arrive pas a se connecter on lui dit si c'est mot de paésse qui est incorrecte ou son id d'utilisateur
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
</html>