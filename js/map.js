L.Icon.Default.imagePath = '../leaflet/images/marker.png'


var map = L.map('map', {
    crs: L.CRS.Simple,
    minZoom: -3
});

var bounds = [[-26.5, -25], [1021.5, 1023]];
var image = L.imageOverlay('../leaflet/images/plan.png', bounds).addTo(map);

var sol = L.latLng([145, 175]);
L.marker(sol).addTo(map);

map.setView([70, 120], 1);

map.fitBounds(bounds);