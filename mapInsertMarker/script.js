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

