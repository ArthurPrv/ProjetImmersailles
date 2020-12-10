<link rel="stylesheet" href="../css/timeline/timeline.css">
<link rel="stylesheet" href="../css/timeline/timeline_2.css">
<script src="../css/timeline/http_cdnjs.cloudflare.com_ajax_libs_jquery_3.2.1_jquery.js"></script>
<script src="../css/timeline/http_www.csslab.cl_ejemplos_timelinr_latest_js_jquery.timelinr-0.9.54.js"></script>

<!--leaflet css -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

<link rel="stylesheet" href="../css/leaflet/leaflet.css">
<script src="../js/leaflet/leaflet.js"></script>

<?php

include("connexion_bdd.php");
//REQUETE POUR RECUPERER LA PLUS PETITE DATE DE LA BDD
$results3 = $db->query("SELECT MIN(Annee) miniAnnee FROM Carte_Nvx;")->fetch();

//Initialisation des valeurs année et niveau
$annee = isset($_POST['annee']) ? $_POST['annee'] : $results3['miniAnnee'];
$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : 1;

$results2 = $db->query("SELECT COUNT(*) compte FROM Carte_Nvx WHERE Annee = '" . $annee . "' AND Niveaux = '" . $niveau . "';");
$ligne2 = $results2->fetch();
if ($ligne2['compte'] == 0) {

    $results = $db->query("SELECT min(Niveaux) maxi FROM Carte_Nvx WHERE Annee = '" . $annee . "';");
    $ligne3 = $results->fetch();
    $niveau = $ligne3['maxi'];
}


?>

<style>
    #map {
        width: 100%;
        height: 100%;
        right: 0.5%;
    }

    #dates {
        margin-top: 150% !important;

    }

    #marginTop {
        height: 60% !important;
    }

    #croix {
        cursor: pointer
    }

    #PopupMarker {
        display: none;
        height: 82%;
        min-width: 370px;
        background-color: #171a1d;
        border-left-width: 5px !important;
        border-bottom-width: 5px !important;
        border-top-width: 1px !important;
        border-right-width: 0 !important;
    }

    #OH ul {
        left: 0 !important;
        right: 0 !important;
        max-height: 20%;
        overflow-y: auto;
        overflow-x: hidden;
    }</style>

<body id="body">


<div class=" d-inline-flex bottom-0 d-inline-block pl-3  " id="marginTop" style="">

    <!-- Timeline des niveaux-->
    <div id="timeline" class="input-flex-container  d-inline-block mt-3">
        <ul id="dates">
            <?php
            $results = $db->query("SELECT Niveaux FROM Carte_Nvx WHERE Annee='" . $annee . "' ;");

            while ($ligne2 = $results->fetch()) {

                if ($niveau == $ligne2['Niveaux']) {

                    echo "<li><a href='#" . $ligne2['Niveaux'] . "' class='selected'>" . $ligne2['Niveaux'] . "</a></li>";

                } else {

                    echo "<li><a href='#" . $ligne2['Niveaux'] . "'>" . $ligne2['Niveaux'] . "</a></li>";

                }
            }
            $results->closeCursor();


            ?>
        </ul>


    </div>


    <div class="flex-parent d-inline-block  pb-3 mt-3">

        <?php
        $results = $db->query("SELECT Carte FROM Carte_Nvx WHERE Annee = " . $annee . " AND Niveaux = '" . $niveau . "';");
        while ($ligne = $results->fetch()) {
            $lien = $ligne['Carte'];
        }
        $results->closeCursor();
        ?>
        <!-- Division centrale avec la carte interactive (Leaflet) -->
        <div id="map"></div>


    </div>


    <!-- Division d'affichage des données Wikidata -->
    <div id="PopupMarker" class="ml-auto col-2 h-auto  ">
        <div id="croix" class="text-right mb-2"></div>


        <span id="ID_Wikidata"></span>


    </div>


</div>


<form id="ID_Formulaire" action="" method="post">
    <input type="hidden" ID="annee" name="annee">
    <input type="hidden" ID="niveau" name="niveau">

    <noscript><input type="submit" value="VALIDER" class="button"></noscript>

</form>


<!-- Timeline des années-->
<div class="input-flex-container mb-auto">


    <?php


    $results = $db->query("SELECT Annee FROM Carte_Nvx GROUP BY Annee");
    while ($ligne = $results->fetch()) {

        $temp_annee = $ligne['Annee'];
        $class = $temp_annee == $annee ? 'input active' : 'input';
        echo "
                    <div class='" . $class . "'  data-year='" . $temp_annee . "'>
                    <span data-year='" . $temp_annee . "' class=data-year data-info='' ></span>
                </div>";

    }
    $results->closeCursor();
    ?>
</div>


<!-- Script pour la Timeline des niveaux -->
<script>
    var niveau2 = '<?php echo $niveau ?>';


    $(function () {

        $().timelinr({
                orientation: 'vertical',

                datesSpeed: 0,
                arrowKeys: 'true',
                startAt: 'ffe'

            }
        )


    });

    $("#dates").on("click", function () {

        $("#niveau").val($("#dates").find('a.' + "selected").text());


        if (niveau2 !== $("#niveau").val()) $("#ID_Formulaire").submit();


    });
</script>


<!-- Script pour la Timeline des dates -->
<script>


    $("#annee").val(<?php echo $annee ?>);

    $(function () {


        var inputs = $(".input");


        var paras = $(".description-flex-container").find("p");
        inputs.click(function () {
            var t = $(this),
                ind = t.index(),

                matchedPara = paras.eq(ind);

            $("#annee").val(t.data("year"));
            t.add(matchedPara).addClass("active");
            inputs.not(t).add(paras.not(matchedPara)).removeClass("active");

            $("#ID_Formulaire").submit();
        });

    });

</script>


<link rel='stylesheet' href='../css/styles.css'>
<!-- script pour la carte -->
<script>


    var versailleIcon = L.icon({
        iconUrl: '../images/marker.png',
        iconAnchor: [19, 50],
        popupAnchor: [0, -50],
    });


    var map = L.map('map', {
        crs: L.CRS.Simple,
        minZoom: -3
    });

    var yx = L.latLng;

    var xy = function (x, y) {
        if (L.Util.isArray(x)) {    // When doing xy([x, y]);
            return yx(x[1], x[0]);
        }
        return yx(y, x);  // When doing xy(x, y);
    };


    var bounds = [xy(0, 0), xy(6507, 2319)];
    var image = L.imageOverlay('<?php echo $lien?>', bounds).addTo(map);

    var booleanMarker = 0;

    <?php
    $results = $db->query("SELECT x,y,Niveaux,Annee, Label_OH,ID_OH FROM MARKER NATURAL JOIN OH WHERE Annee = " . $annee . " AND Niveaux = '" . $niveau . "';");
    while ($ligne = $results->fetch()) {
    ?>
    var markerAssocie = "";

    var vide = "";


    //Récuperation des données Wikidata
    var marker = L.marker(xy(<?php echo $ligne['x'] ?>,<?php echo $ligne['y'] ?>), {icon: versailleIcon})
    marker.on('click', function () {


        if (booleanMarker === 1 && markerAssocie === <?php echo "'{$ligne['ID_OH']}'"; ?>) {

            $('#PopupMarker').hide();
            booleanMarker = 0;
        } else {
            $('#PopupMarker').show();
            $('#ID_Wikidata').html(

                <?php


                $id = "{$ligne['ID_OH']}";
                $link = 'https://www.wikidata.org/wiki/Special:EntityData/' . $id . '.json';
                $objet = json_decode(file_get_contents($link));
                $objetV2 = $objet->entities->$id->claims;


                //_________________Avoir l'image_____________________
                if (isset($objetV2->P18[0]->mainsnak->datavalue->value)) {
                    $filename = ($objetV2->P18[0]->mainsnak->datavalue->value);
                    $safeFilename = str_replace(" ", "_", $filename);
                    $md5SafeFilename = md5($safeFilename);
                    $filenameForUpload = 'https://upload.wikimedia.org/wikipedia/commons/' . substr($md5SafeFilename, 0, 1) . '/' . substr($md5SafeFilename, 0, 2) . '/' . $safeFilename;
                    $imageLink = "<br/><div style=\'text-align: center \'><img  height=200px width = auto src=\"" . $filenameForUpload . "\" ></div>";
                } else {
                    $imageLink = "<br/>Aucune image n\'existe pour ce marker";

                }



                //_________________Avoir le nom_____________________

                if (isset($objetV2->P1559[0]->mainsnak->datavalue->value->text)) {
                    $nameInOriginalState = "<div style=\' font-size:22px; text-align: center ;font-weight : bold ; color:#E99C16 \' >" . addslashes($objetV2->P1559[0]->mainsnak->datavalue->value->text) . "</div>";
                } else {
                    $nameInOriginalState = "Le nom de cette personne n\'est pas défini";
                }



                //_________________Avoir la date de naissance + lieu_____________________
                if (isset($objetV2->P569[0]->mainsnak->datavalue->value->time)) {
                    $dateOfBirth = (date('d-m-Y ', strtotime($objetV2->P569[0]->mainsnak->datavalue->value->time)));
                } else {
                    $dateOfBirth = "La date de naissance est inconnue";
                }
                if (isset($objetV2->P19[0]->mainsnak->datavalue->value->id)) {
                    $birthPlaceID = ($objetV2->P19[0]->mainsnak->datavalue->value->id);


                    $linkBirth = 'https://www.wikidata.org/wiki/Special:EntityData/' . $birthPlaceID . '.json';
                    $objetBirth = json_decode(file_get_contents($linkBirth));
                    $birthPlace = addslashes($objetBirth->entities->$birthPlaceID->labels->fr->value);

                } else {
                    $birthPlace = "L\'endroit de naissance est inconnu";
                }





                //__________________Avoir la date de mort + lieu_____________________
                if (isset($objetV2->P570[0]->mainsnak->datavalue->value->time)) {
                    $dateOfDeath = (date('d-m-Y ', strtotime($objetV2->P570[0]->mainsnak->datavalue->value->time)));
                } else {
                    $dateOfDeath = "La date de décès est inconnue";
                }

                if (isset($objetV2->P20[0]->mainsnak->datavalue->value->id)) {
                    $deathPlaceID = $objetV2->P20[0]->mainsnak->datavalue->value->id;


                    $linkdeath = 'https://www.wikidata.org/wiki/Special:EntityData/' . $objetV2->P20[0]->mainsnak->datavalue->value->id . '.json';
                    $objetdeath = json_decode(file_get_contents($linkdeath));
                    $deathPlace = addslashes($objetdeath->entities->$deathPlaceID->labels->fr->value);

                } else {
                    $deathPlace = "L\'endroit du décès est inconnu";
                }


                //_________________Avoir le lien Wikipedia_____________________

                if (isset($objet->entities->$id->sitelinks->frwiki->url)) {
                    $link3 = $objet->entities->$id->sitelinks->frwiki->url;
                    $lienWikipedia = "<br/><a target=\"_blank\" href=\"" . $link3 . "\">Plus d\'infos</a>";
                } else {
                    $lienWikipedia = "Pas de page Wikipedia associée";
                }


                //_________________Avoir la description_____________________

                if (isset($objet->entities->$id->descriptions->fr->value)) {
                    $description = $objet->entities->$id->descriptions->fr->value;
                    $descriptionText = "<div style=\'text-align: center\' ><i>" . addslashes($description) . "</i></div>";
                } else {
                    $description = 'Pas de description';
                }




                //_________________description_____________________

                print_r("'{$nameInOriginalState}");
                print_r($imageLink);
                print_r($descriptionText);
                print_r("<br/>Née le:{$dateOfBirth}");
                print_r("<br/>Lieu de naissance :{$birthPlace}");
                print_r("<br/>Décédé le:{$dateOfDeath}");
                print_r("<br/>Lieu de décès : {$deathPlace}");
                print_r("<br/>{$lienWikipedia}'");
                ?>





            );

            $('#PopupMarker').addClass("border border-warning p-3");
            $('#croix').html('&#10006');
            $('#croix').on('click', function () {
                $('#PopupMarker').hide();
                booleanMarker = 0;
            })
            ;
            booleanMarker = 1;
            markerAssocie = <?php echo "'{$ligne['ID_OH']}'"; ?>
        }
    });


    marker.addTo(map);
    <?php


    }
    $results->closeCursor();

    ?>


    map.setView(xy(6507 / 2, 2319 / 2), -2);

</script>


</body>






