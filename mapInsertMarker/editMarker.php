<!--leaflet css -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<title>Immersailles</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" type="text/css" href="../css/autre.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="../css/timeline.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
        type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>


<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


<!--leaflet css -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


<script src="../js/timeline.js" defer charset="UTF-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<link rel="stylesheet" type="text/css" href="../css/autre.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="../css/timeline.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
        type="text/javascript"></script>


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
if (!isset($_POST['Annee']) && !isset($_POST['Niveau'])) {
    $Annee = 2008;
    $Niveau = 1;
} else if (!isset($_POST['Annee'])) {
    $Annee = 2008;
    $Niveau = $_POST['Niveau'];
} else if (!isset($_POST['Niveau'])) {
    $Niveau = 1;
    $Annee = $_POST['Annee'];
} else {
    $Annee = $_POST['Annee'];
    $Niveau = $_POST['Niveau'];
}

$results = $db->query("SELECT Carte FROM Carte_Nvx WHERE Annee = " . $Annee . " AND Niveaux = " . $Niveau . ";");
while ($ligne = $results->fetch()) {
    $lien = $ligne['Carte'];
}
$results->closeCursor();
?>


<form action method='post'>

    <label>Année: </label>
    <select name='Annee' id=\"Annee\" onchange='this.form.submit()'>
        <?php
        $results = $db->query("SELECT Annee FROM Carte_Nvx GROUP BY Annee");
        while ($ligne = $results->fetch()) {
            if ($Annee == $ligne['Annee']) {
                echo "<option selected='selected' value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
            } else {
                echo "<option  value=\"" . $ligne['Annee'] . "\">" . $ligne['Annee'] . "</option>";
            }
        }
        $results->closeCursor();
        ?>
    </select><br><br>

    <label>Niveau: </label>
    <select name='Niveau' id='Niveau' onchange='this.form.submit()'>"
        <?php
        $results = $db->query("SELECT Niveaux FROM Carte_Nvx WHERE Annee='" . $Annee . "';");
        while ($ligne2 = $results->fetch()) {
            if ($Niveau == $ligne2['Niveaux']) echo "<option selected='selected' value=\"" . $ligne2['Niveaux'] . "\">" . $ligne2['Niveaux'] . "</option>";
            else {
                echo "<option value=\"" . $ligne2['Niveaux'] . "\">" . $ligne2['Niveaux'] . "</option>";
            }
        }
        $results->closeCursor();

        ?>
    </select>

    <p>
    <noscript><input type="submit" value="VALIDER" class="button"></noscript>
    </p>

</form>


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
    $results = $db->query("SELECT x,y,Niveaux,Annee, Label_OH,ID_OH FROM MARKER NATURAL JOIN OH WHERE Annee = " . $Annee . " AND Niveaux = " . $Niveau . ";");
    while ($ligne = $results->fetch()) {

        echo "marker = L.marker(xy(" . $ligne['x'] . ", " . $ligne['y'] . "), {icon: versailleIcon}).bindPopup('" . $ligne['ID_OH'] . "');";
        echo "marker.on('dblclick', function(){marker.remove(this);});";
        echo "marker.addTo(map);";

    }
    $results->closeCursor();

    ?>

    //L.marker(xy(175.2, 145.0), {icon: versailleIcon}).addTo(map).bindPopup('Sol');
    //   L.marker(mizar, {icon: versailleIcon}).addTo(map).bindPopup('Mizar');
    // L.marker(kruegerZ, {icon: versailleIcon}).addTo(map).bindPopup('Krueger-Z');
    //L.marker(deneb, {icon: versailleIcon}).addTo(map).bindPopup('Deneb');


    map.setView(xy(6507 / 2, 2319), -1.80);


    map.on("contextmenu", function (event) {
        console.log("user right-clicked on map coordinates: " + event.latlng.toString());
        var marker = L.marker(event.latlng, {icon: versailleIcon}).bindPopup($("#OH").val());
        marker.on('dblclick', function () {
            marker.remove(this);
        })
        marker.addTo(map);
        console.log(event.latlng.toString().slice(7, -1).split(","));

        /*
                arrayMarker.push([$("#OH").val(), event.latlng.toString().slice(7, -1).split(",")]);
                console.log(getArrayMarker());
                $("#toto").val(arrayMarker);
                console.log($("#toto").val());
                */

    });


    //ZONE DE TESTE
    // getting all the markers at once


    //ZONE DE TESTE


</script>

<?php
include("../html/connexion_bdd.php");
$results = $db->query("SELECT ID_OH FROM OH;");

echo "<label>OH: </label>";
echo "<select name = 'OH' id=\"OH\">";
$i = 0;
while ($ligne = $results->fetch()) {

    if ($i == 0) echo "<option selected=\"selected\" value=\"" . $ligne['ID_OH'] . "\">" . $ligne['ID_OH'] . "</option>";
    else echo "<option value=\"" . $ligne['ID_OH'] . "\">" . $ligne['ID_OH'] . "</option>";
    $i++;
}
$results->closeCursor();
echo '</select><br><br>';


?>
</body>


</html>


