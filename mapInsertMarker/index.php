<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <link rel="stylesheet" href="../leaflet/leaflet.css">
    <script src="../leaflet/leaflet.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div id="map"></div>
<input ID="toto" type="text" value="">

<?php
include("../html/connexion_bdd.php");
$results = $db->query("SELECT ID_OH FROM OH;");

echo "<label>OH: </label>";
echo "<select name = 'OH' id=\"OH\">";
while ($ligne = $results->fetch()) {
    echo "<option value=\"" . $ligne['ID_OH'] . "\">" . $ligne['ID_OH'] . "</option>";
}
$results->closeCursor();
echo '</select><br><br>';
?>

<script>

    var arrayMarker = [];

    function getArrayMarker() {
        return arrayMarker;
    }


    var map = L.map("map").setView([48.85, 2.35], 12);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    map.on("contextmenu", function (event) {
        console.log("user right-clicked on map coordinates: " + event.latlng.toString());
        L.marker(event.latlng).addTo(map);
        console.log(event.latlng.toString().slice(7, -1).split(","));


        arrayMarker.push([$("#OH").val(), event.latlng.toString().slice(7, -1).split(",")]);
        console.log(getArrayMarker());
        $("#toto").val(arrayMarker);
        console.log($("#toto").val());
    });
</script>
</body>


</html>