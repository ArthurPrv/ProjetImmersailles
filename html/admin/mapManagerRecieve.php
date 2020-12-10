<?php
session_start();
if (!isset($_SESSION['Profil'])) {
    header('location:../Index.php');
} elseif ($_SESSION['Profil'] != 'Administrateur') {
    header("location:../Index.php");
}


include("../connexion_bdd.php");

if (isset($_POST['lvl']) && isset($_POST['year']) && isset($_POST['plan'])) {
    //verifier l'existance de cette corespondance dans la base de donnée
    $results = $db->query("SELECT COUNT(*) compare FROM Carte_Nvx WHERE Niveaux='{$_POST['lvl']}' AND Annee='{$_POST['year']}';")->fetch();

    if ($results['compare'] > 0) {
        //Si cette combinaison carte nvx annee existe deja dans la bdd
        if ($_POST['plan'] == "del") {
            $db->query("DELETE FROM `Carte_Nvx` WHERE Niveaux='{$_POST['lvl']}' AND Annee='{$_POST['year']}';")->fetch();
            $yearStay = $db->query("SELECT COUNT(*) compare FROM Carte_Nvx WHERE Annee='{$_POST['year']}';")->fetch();
            if ($yearStay['compare'] <= 0) {
                $db->query("DELETE FROM ANNEE WHERE Annee='{$_POST['year']}';")->fetch();
            }


        } else {

            echo "1";
            $db->query("UPDATE `Carte_Nvx` SET `Carte`='{$_POST['plan']}' WHERE Niveaux='{$_POST['lvl']}' AND Annee='{$_POST['year']}'")->fetch();
        }
    } else {
        //Si la combinaison carte nvx annee n'existe pas dans la bdd
        echo "2";


        $isYearhere = $db->query("SELECT COUNT(*) compare FROM ANNEE WHERE Annee={$_POST['year']}")->fetch();
        if ($isYearhere['compare'] == '0') {
            $db->query("INSERT INTO `ANNEE`(`Annee`) VALUES ({$_POST['year']})")->fetch();
        }
        $db->query("INSERT INTO `Carte_Nvx`(`Niveaux`, `Carte`, `Annee`) VALUES ('{$_POST['lvl']}','{$_POST['plan']}','{$_POST['year']}')")->fetch();

    }
}
header("Location:mapManager.php");