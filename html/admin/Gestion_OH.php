<?php
session_start();
if (!isset($_SESSION['Profil'])) {
    header('location:../Index.php');
}


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <title>Gestion Objets Historiques</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Exo+2:ital,wght@0,300;1,500' rel='stylesheet' type='text/css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
            type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="../../DataTables/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="../../DataTables/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../DataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../js/DataTable.js"></script>
    <script type="text/javascript" src="../../DataTables/dataTables.bootstrap4.min.js"></script>


    <link rel="icon" type="image/png" href="../../images/autre/logo_mini.png"/>

    <link rel="stylesheet" href="../../css/timeline/timeline.css">
    <link rel="stylesheet" href="../../css/timeline/timeline_2.css">
</head>
<?php
include("header.php");
include '../connexion_bdd.php';
?>
<body style=" background-color: rgba(255,203,72,0.25);">
<div class="d-block   ">

    <!-- ajout d'un nouvel Objet Historique-->
    <div class="ml-3 d-inline-flex pr-3 border-dark pb-3" style="width: 48%">
        <div style=" width: 100%; margin:3% 20% 3% 20% ;  border-radius: 10px; background-color: #49494A; color: white">
            <form action="" method="post" style="text-align:center !important;">

                <h2 style="text-align:center">Ajout OH</h2>
                <p style="text-align: center">Vous allez ajouter un nouvel Objet Historique à la base de données : </p>

                <br>


                <label>Identifiant Wikidata : </label><br>
                <label>
                    <input type="text" name="ID_OH">
                </label><br>

                <label>Type: </label><br>
                <label>
                    <select name="Type_OH">
                        <option selected=selected value="Personnage">Personnage</option>
                        <option value="Mobilier">Mobilier</option>

                    </select>
                </label><br>

                <label>Label : </label><br>
                <label>
                    <input type="text" name="Label_OH">
                </label><br>


                <p class="py-2">
                    <input type="submit" value="VALIDER" class="button">
                </p>

            </form>
            <?php


            if (isset($_POST['ID_OH']) && isset($_POST['Type_OH']) && isset($_POST['Label_OH'])) {
                if ($_POST['ID_OH'] != '' && $_POST['Label_OH'] != '') {


                    //Ajout d'un nouveau utilisateur dans la base de donnée et affiche un message pour informer l'administrateur
                    echo "<p style='text-align: center'>L'objet Historique suivant a été ajouté : <a target='_blank' href='https://www.wikidata.org/wiki/" . $_POST['ID_OH'] . "'>Page Wikidata</a> </p>";
                    $results2 = $db->exec('INSERT INTO OH VALUES ("' . $_POST['ID_OH'] . '","' . $_POST['Label_OH'] . '","' . $_POST['Type_OH'] . '");');
                }

            }


            ?>
        </div>
    </div>

    <!-- Suppression Objet Historique-->
    <div id="div2" class="ml-3 d-inline-flex pr-3  border-dark pb-3" style="width: 48%">
        <div style=" width: 100%; margin:3% 20% 3% 20% ;  border-radius: 10px; background-color: #49494A; color: white">
            <form action="" method="post" style="text-align:center !important;">

                <h2 style="text-align:center">Suppression OH</h2>
                <p style="text-align: center">Choisissez un Objet Historique à supprimer: </p>

                <br>
                <label>
                    <select name="ID_OH_Select">
                        <?php

                        $results2 = $db->query("SELECT ID_OH, Label_OH FROM OH ;");
                        while ($ligne2 = $results2->fetch()) {
                            echo '<option value="' . $ligne2['ID_OH'] . '">' . $ligne2['Label_OH'] . '</option>';
                        }

                        ?>
                    </select>
                </label>


                <p class="py-2">
                    <input type="submit" value="SUPPRIMER" class="button">
                </p>

            </form>
            <?php


            if (isset($_POST['ID_OH_Select'])) {


                //Ajout d'un nouveau utilisateur dans la base de donnée et affiche un message pour informer l'administrateur
                echo "<p style='text-align: center'>L'objet Historique suivant a été suivant : <a target='_blank' href='https://www.wikidata.org/wiki/" . $_POST['ID_OH_Select'] . "'>Page Wikidata</a> </p>";
                $results2 = $db->exec('DELETE FROM OH WHERE ID_OH = "' . $_POST['ID_OH_Select'] . '";');


            }


            ?>
        </div>
    </div>
</div>

<div class="fixed-bottom">
    <?php

    include '../footer.php';
    ?></div>
</body>
</html>