<?php
include("connexion_bdd.php");
//todo: redirection permission et redirection basique
if (isset($_FILES['icone']) && isset($_POST['year']) && isset($_POST['lvl'])) {
    $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['icone']['name'], '.'), 1));
    if (in_array($extension_upload, $extensions_valides)) {
        // L'extension est correcte
        $nom = "../images/plans/{$_FILES['icone']['name']}";
        $resultat = move_uploaded_file($_FILES['icone']['tmp_name'], $nom);

        //ajouter dans cartenvx l'etage le nvx et la nvxelle carte
        $results = $db->query("INSERT INTO `Carte_Nvx`(`Niveaux`, `Carte`, `Annee`) VALUES ('{$_POST['lvl']}','{$nom}','{$_POST['year']}')");
        $results->fetch();
        print_r("yes du premier cp");
    } else {
        print_r(" raté 2");
    }


} else {
    echo " raté 1";
}