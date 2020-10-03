<?php
/* Connexion au serveur et à la base de données */
$host = "sqletud.u-pem.fr";
$user = "tvexiau"; /* Votre login */
$pwd = "c2tjYia5au"; /* Votre mot de passe */
$dbh = "tvexiau_db"; /* Le nom de votre base : de la forme ici : xxx_db avec xxx votre login */

// Connexion avec avec PDO
try {
    $con = "mysql:host=$host;dbname=$dbh";
    $db = new PDO($con, $user, $pwd);
    $db->exec('SET NAMES utf8');

} catch (Exception $e) {
    die('Connexion impossible à la base de données !' . $e->getMessage());

}
?>