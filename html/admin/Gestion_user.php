<?php
include("header.php");
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
            //Vérifie quel choix l'adiministrateur a fait (ajouter ou modifier les données d'un utilisateur)
            if ($_POST['action'] == 'add') {
                //formulaire pour permettre de rentrer les données d'unh nouveau utilisateur
                echo "<h2>Ajout utilisateur</h2>";
                echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');
                echo '<p>Vous allez ajouter un nouvel utilisateur à la base de données : </p>';
                ?>
                <br>
                <label>ID : </label><br>
                <input type="number" name="ID"><br>

                <label>Login : </label><br>
                <input type="text" name="Login"><br>

                <label>Role : </label><br>
                <select name="Role">
                    <option value="Administrateur">Administrateur</option>
                    <option value="Contributeur">Contributeur</option>

                </select><br>


                <label>Adresse mail : </label><br>
                <input type="text" name="mail"><br>

                <label>Mot de passe : </label><br>
                <input type="text" name="mdp"><br>

                <?php
            } elseif ($_POST['action'] == 'modify') {
                echo "<h2>Modifier employé</h2>";
                echo('<input type=hidden name=action value=' . $_POST['action'] . '> ');
                include '../connexion_bdd.php';
                //requete permettant d'afficher tous les employés de la plateforme sous la forme d'un tableau
                $results = $db->query("SELECT ID_User, Login, Profil, Mail FROM AUTHENTIFICATION;");
                echo '<table>';
                echo '<tr><th></th><th>Numéro Utilisateur</th><th>Login</th><th>Role</th><th>Mail</th></tr>';
                while ($ligne = $results->fetch()) {

                    echo '<tr><td><input type="radio" name="ID" value="' . $ligne['ID_User'] . '"></td><td>' . $ligne['ID_User'] . '</td><td>' . $ligne['Login'] . '</td><td>' . $ligne['Profil'] . '</td><td>' . $ligne['Mail'] . '</td></tr>';
                }
                echo '</table>';
            }

            ?>

            <p>
                <input type="reset" value="Retour" class="button">
                <input type="submit" value="VALIDER" class="button">
            </p>
        </form>
    </div>
<?php } else {
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