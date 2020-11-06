<form action="" method="post">


    <?php
    include("connexion_bdd.php");
    $results = $db->query("SELECT DISTINCT(Annee) FROM Carte_Nvx;");


    ?>

    <h2>Ajout Point</h2>
    <p>Vous allez ajouter un nouvel Marker à la base de données : </p>


    <?php
    echo "<label>Année: </label>";
    echo "<select name=\"annee\">";
    while ($ligne = $results->fetch()) {
        echo "<option value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
    }
    $results->closeCursor();
    echo '</select><br><br>';

    $results = $db->query("SELECT DISTINCT Niveaux FROM Carte_Nvx;");
    echo "<label>Niveau: </label>";
    echo "<select name=\"niveau\">";
    while ($ligne = $results->fetch()) {
        echo "<option value=\"" . $ligne['Niveaux'] . "\">" . $ligne['Niveaux'] . "</option>";
    }
    $results->closeCursor();
    echo '</select><br><br>';


    ?>


    <p>


        <input type="submit" value="Envoyez" class="button">
    </p>
</form>


<?php
if (isset($_POST['annee']) && isset($_POST['niveau'])) {


}


/*
$results = $db->query("SELECT ID_OH,Label_OH,Type_OH FROM OH;");
echo "<label>Objet: </label>";
echo "<select name=\"objet\">";
   while ($ligne = $results->fetch()) {
   echo "<option value=\"" . $ligne['ID_OH'] . "\">" . $ligne['ID_OH'] . "  -->  " . $ligne['Label_OH'] . "  -->  " . $ligne['Type_OH'] . "</option>";
   }
   $results->closeCursor();
   echo '</select><br><br>';


*/
?>