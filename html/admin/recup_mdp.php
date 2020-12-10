<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
        type="text/javascript"></script>
<link href='https://fonts.googleapis.com/css?family=Exo+2:ital,wght@0,300;1,500' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="../../css/timeline/timeline.css">
<link rel="stylesheet" href="../../css/timeline/timeline_2.css">
<link rel="icon" type="image/png" href="../../images/autre/logo_mini.png"/>
<?php
include("header.php");


// Creer le code de recuperation
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

session_start();
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
<body style=" background-color: rgba(255,203,72,0.25);">
<div style=" padding:10px;width: 30%; margin-left: auto ; margin-right: auto ; margin-top: 3%; border-radius: 10px; background-color: #49494A; color: white">
    <form action="recup_mdp2.php" method="post" style="text-align:center !important;">

        <label for="Mail">Adresse mail de recupération :</label> <br>
        <input size='30' type="email" id="Mail" name="Mail" required> <br><br>


        <input type="submit" name="submit" value="Envoyer">


    </form>
</div>

<div class="fixed-bottom">
    <?php

    include '../footer.php';
    ?></div>
</body>






