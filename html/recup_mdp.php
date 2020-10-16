<?php
include("header.php");
function genererChaineAleatoire($longueur = 0)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++) {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;


}

$code = genererChaineAleatoire(10);
$_SESSION['Code'] = $code;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération Mot de Passe </title>
</head>
<body>
<form action="recup_mdp2.php" method="post">

    <label for="Mail">Adresse mail de recupération :</label> <br>
    <input type="email" id="Mail" name="Mail" required> <br><br>


    <input type="reset" name="reset" value="Annulez">
    <input type="submit" name="submit" value="Envoyer">


</form>








