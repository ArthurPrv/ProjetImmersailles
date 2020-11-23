<form method="post" action="addMapToServerRecive.php" enctype="multipart/form-data">
    <label for="iconeNvx">Niveaux :</label><br/>
    <input name="lvl" id="lvl" type="number" value="0"><br/>


    <label for="iconeYear">Année :</label><br/>
    <SELECT name="year" size="1">
        <?php
        include("connexion_bdd.php");
        $results = $db->query("SELECT Annee FROM ANNEE");
        while ($ligne = $results->fetch()) {
            echo("<OPTION value={$ligne['Annee']}>" . $ligne['Annee']);
        }
        $results->closeCursor();
        ?>
    </SELECT><br/>
    <input type="file" name="icone" id="icone"/><br/>
    <input type="submit" name="submit" value="Envoyer"/>
</form>