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

        <label for="ID_user">Matricule :</label> <br>
        <input type="number" id="ID_user" name="ID_user" autocomplete="on" autofocus required> <br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" placeholder="******" required> <br>

        <input type="reset" name="reset" value="Annulez">
        <input type="submit" name="submit" value="Envoyer">
    </form>


    <?php
    //on vérifie si l'utilisateur a bien rentrer les informations sinon on lui dit qu'il n'as pas rempli les champs
    session_start();
    if (isset($_POST['ID_user']) && isset($_POST['mdp'])) {
        if (empty($_POST['ID_user'])) {
            echo "<p class='erreur'>Login non renseigné dans le formulaire !</p>\n";
        } else if (empty($_POST['mdp'])) {
            echo "<p class='erreur'>Mot de passe non renseigné dans le formulaire !</p>\n";
        } else {
            include('connexion_bdd.php');
            //requete permettant de savoir si les données se trouvent bien dans la base de données
            $sql = "SELECT * FROM IMMERSAILLES_Authentification WHERE ID_User='" . $_POST['ID_user'] . "' AND Password='" . $_POST['mdp'] . "';";
            $result = $db->query($sql);
            $nb = $result->rowCount();
            $result->closeCursor();
            if ($nb == 1) {
                // si oui on initialise nos variables de Sessions puis on redirige l'utilisateur sur ca page d'accueil selon son role
                $_SESSION['ID_user'] = $_POST['ID_user'];
                $_SESSION['mdp'] = $_POST['mdp'];

                $sql = "SELECT Nom, Prenom, Role FROM IMMERSAILLES_Authentification WHERE ID_User='" . $_POST['ID_user'] . "';";
                $result = $db->query($sql);
                while ($ligne = $result->fetch()) {
                    echo($ligne["Nom"]);
                    $_SESSION['nom'] = $ligne['Nom'];
                    $_SESSION['prenom'] = $ligne['Prenom'];
                    $_SESSION['role'] = $ligne['Role'];
                    $result->closeCursor();
                }

            } else {
                // s'il n'arrive pas a se connecter on lui dit si c'est mot de paésse qui est incorrecte ou son id d'utilisateur
                $sql = "SELECT * FROM IMMERSAILLES_Authentification WHERE ID_User='" . $_POST['ID_user'] . "';";
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