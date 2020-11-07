<!--leaflet css -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
    #map {
        width: 70%;
        height: 70%;
    }
</style>
<body>
<div id="map">

</div>


<?php
include("../html/connexion_bdd.php");
$lien = "../images/plan.png";
$Annee = 2008;
$Niveau = 1;
if (isset($_POST['Annee']) && isset($_POST['Niveau'])) {


    $results2 = $db->query("SELECT Niveaux, Carte, Label ,Annee FROM Carte_Nvx WHERE Annee = " . $_POST['Annee'] . " AND Niveaux = " . $_POST['Niveau'] . ";");

    $count = 0;
    while ($ligne2 = $results2->fetch()) {
        $count++;
        $lien = $ligne2['Carte'];

        $Niveau = $_POST['Niveau'];
    }
    $Annee = $_POST['Annee'];
    if ($count == 0) {
        $lien = "../images/plan.png";
    }

    echo "<form action=\"\" method=\"post\">";


    $results = $db->query("SELECT Annee FROM ANNEE;");


    echo "<label>Année: </label>";
    echo "<select name = 'Annee' id=\"Annee\">";
    while ($ligne = $results->fetch()) {
        if ($ligne['Annee'] == $Annee) {
            echo "<option selected = selected value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
        } else {
            echo "<option value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
        }
    }
    $results->closeCursor();
    echo '</select><br><br>';


    ?>

    <label>Niveau: </label>
    <select name='Niveau' id=\"Niveau\">"
        <?php
        if ($Niveau == 1) {
            echo "<option selected = selected value='1'>1</option><option value='2'>2</option><option value='3'>3</option>";
        } else if ($Niveau == 2) {
            echo "<option value='1'>1</option><option  selected = selected value='2'>2</option><option value='3'>3</option>";
        } else {
            echo "<option value='1'>1</option><option value='2'>2</option><option selected = selected  value='3'>3</option>";
        }
        ?>


    </select>
    <p>

        <input type="submit" value="VALIDER" class="button">
    </p>

    </form>
    <?php
} else {
    ?>

    <form action="" method="post">
        <?php
        include("../html/connexion_bdd.php");


        $results = $db->query("SELECT Annee FROM ANNEE;");


        echo "<label>Année: </label>";
        echo "<select name = 'Annee' id=\"Annee\">";
        while ($ligne = $results->fetch()) {

            echo "<option value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
        }
        $results->closeCursor();
        echo '</select><br><br>';


        ?>

        <label>Niveau: </label>
        <select name='Niveau' id=\"Niveau\">"
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>

        </select>
        <p>

            <input type="submit" value="VALIDER" class="button">
        </p>

    </form>

    <?php


}


?>


<script>
    var versailleIcon = L.icon({
        iconUrl: '../images/marker.png',
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
    $results = $db->query("SELECT x,y,Niveaux,Annee, Label_OH FROM MARKER NATURAL JOIN OH WHERE Annee = " . $Annee . " AND Niveaux = " . $Niveau . ";");
    while ($ligne = $results->fetch()) {

        echo "L.marker(xy(" . $ligne['x'] . ", " . $ligne['y'] . "), {icon: versailleIcon}).addTo(map).bindPopup('" . $ligne['Label_OH'] . "');";
    }
    $results->closeCursor();

    ?>

    //    L.marker(xy(175.2, 145.0), {icon: versailleIcon}).addTo(map).bindPopup('Sol');
    //   L.marker(mizar, {icon: versailleIcon}).addTo(map).bindPopup('Mizar');
    // L.marker(kruegerZ, {icon: versailleIcon}).addTo(map).bindPopup('Krueger-Z');
    //L.marker(deneb, {icon: versailleIcon}).addTo(map).bindPopup('Deneb');


    map.setView(xy(6507 / 2, 2319), -1.80);


</script>

</body>


</html>


