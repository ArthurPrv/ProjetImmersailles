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
<div class="tl-wrapper bg-white" style="height: 699px">

    <ul class="timeline">


        <li class="tl-item" data-year="1981">
            <div id="map">

            </div>

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
                var image = L.imageOverlay('../images/plan.png', bounds).addTo(map);

                var sol = xy(175.2, 145.0);
                var mizar = xy(41.6, 130.1);
                var kruegerZ = xy(13.4, 56.5);
                var deneb = xy(218.7, 8.3);

                L.marker(sol, {icon: versailleIcon}).addTo(map).bindPopup('Sol');
                L.marker(mizar, {icon: versailleIcon}).addTo(map).bindPopup('Mizar');
                L.marker(kruegerZ, {icon: versailleIcon}).addTo(map).bindPopup('Krueger-Z');
                L.marker(deneb, {icon: versailleIcon}).addTo(map).bindPopup('Deneb');

                var travel = L.polyline([sol, deneb]).addTo(map);

                map.setView(xy(6507 / 2, 2319), -1.80);


            </script>
            <div class="tl-copy ">
                <h3 class="title">Test 1</h3>
                <div class="tl-description">
                    <p>Test 2</p>
                </div>
            </div>

        </li>


        <li class="tl-item" data-year="1982">
            <div id="map2">

            </div>
            <div class="tl-copy ">
                <h3 class="title">Test 2</h3>
                <div class="tl-description">
                    <p>Test 3</p>
                </div>
            </div>

        </li>

    </ul>
</div>

