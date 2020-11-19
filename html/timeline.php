<link rel="stylesheet" href="../css/timeline/timeline.css">
<link rel="stylesheet" href="../css/timeline/timeline_2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://www.csslab.cl/ejemplos/timelinr/latest/js/jquery.timelinr-0.9.54.js"></script>

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
$results3 = $db->query("SELECT MIN(Annee) miniAnnee FROM Carte_Nvx;")->fetch();


$annee = isset($_POST['annee']) ? $_POST['annee'] : $results3['miniAnnee']; //REQUETE AVEC PETITE
$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : 1;
$results2 = $db->query("SELECT COUNT(*) compte FROM Carte_Nvx WHERE Annee = '" . $annee . "' AND Niveaux = '" . $niveau . "';");
$ligne2 = $results2->fetch();
if ($ligne2['compte'] == 0) {
    $niveau = 1;
}


?>

<style>
    #map {
        width: 100%;
        height: 115%;
    }

    #dates {
        margin-top: 150% !important;

    }
</style>

<body>
<form id="ID_Formulaire" action="" method="post">
    <input type="hidden" ID="annee" name="annee">
    <input type="hidden" ID="niveau" name="niveau">
    <p>
    <noscript><input type="submit" value="VALIDER" class="button"></noscript>
    </p>
</form>


<div class="d-inline-flex bottom-0 mb-auto h-50 d-inline-block pl-3 pr-5" id="marginTop" style="">


    <div id="timeline" class="input-flex-container d-inline-block">
        <ul id="dates">
            <?php
            $results = $db->query("SELECT Niveaux FROM Carte_Nvx WHERE Annee='" . $annee . "';");
            while ($ligne2 = $results->fetch()) {
                if ($niveau == $ligne2['Niveaux']) {
                    echo "<li><a href='#" . $ligne2['Niveaux'] . "' class='selected'>" . $ligne2['Niveaux'] . "</a></li>";
                } else {
                    echo "<li><a href='#" . $ligne2['Niveaux'] . "' >" . $ligne2['Niveaux'] . "</a></li>";
                }
            }
            $results->closeCursor();

            /*
            <li><a href="#1" class="selected">1</a></li>
            <li><a href="#2">2</a></li>
            <li><a href="#3">3</a></li>*/
            ?>
        </ul>


    </div>


    <div class="flex-parent d-inline-block">


        <?php
        $results = $db->query("SELECT Carte FROM Carte_Nvx WHERE Annee = " . $annee . " AND Niveaux = " . $niveau . ";");
        while ($ligne = $results->fetch()) {
            $lien = $ligne['Carte'];
        }
        $results->closeCursor();
        ?>

        <div id="map"></div>

        <div class="input-flex-container ">


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


    </div>


</div>


<script>

    // $("#niveau").val(<?php echo $niveau ?>) ;
    $(function () {

        $().timelinr({
                orientation: 'vertical',

                datesSpeed: 0,
                arrowKeys: 'true',
                startAt:        <?php echo $niveau ?>

            }
        )


    });
    $boolean = 1;
    $("#dates").on("click", function () {
        if ($boolean == 1) {
            $boolean = 0;
        } else {


            // console.log($("#dates").find('a.'+"selected").text());
            $("#niveau").val($("#dates").find('a.' + "selected").text());
            console.log($('#niveau').val());
            console.log(<?php echo $niveau ?> );


            $("#ID_Formulaire").submit();
        }


    });
</script>
<script>


    //THOMAS LE SORCIER
    $("#annee").val(<?php echo $annee ?>);

    $(function () {


        var inputs = $(".input");


        var paras = $(".description-flex-container").find("p");
        inputs.click(function () {
            var t = $(this),
                ind = t.index(),

                matchedPara = paras.eq(ind);
            //  console.log(inputs.data("year"));
            console.log(t.data("year"));
            $("#annee").val(t.data("year"));
            t.add(matchedPara).addClass("active");
            inputs.not(t).add(paras.not(matchedPara)).removeClass("active");

            $("#ID_Formulaire").submit();
        });

    });

</script>


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


    <?php
    $results = $db->query("SELECT x,y,Niveaux,Annee, Label_OH,ID_OH FROM MARKER NATURAL JOIN OH WHERE Annee = " . $annee . " AND Niveaux = " . $niveau . ";");
    while ($ligne = $results->fetch()) {

        echo "marker = L.marker(xy(" . $ligne['x'] . ", " . $ligne['y'] . "), {icon: versailleIcon}).bindPopup('" . $ligne['ID_OH'] . "');";

        echo "marker.addTo(map);";

    }
    $results->closeCursor();

    ?>

    map.setView(xy(6507 / 2, 2319 / 2), -2);

</script>

</body>






