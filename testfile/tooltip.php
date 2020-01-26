<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

   <style>
   .tooltip-realtime {
    font-size: 12px;
    text-shadow: 1px 1px 0 #ffffff, 1px -1px 0 #ffffff, -1px 1px 0 #ffffff, -1px -1px 0 #ffffff, 1px 0px 0 #ffffff, 0px 1px 0 #ffffff, -1px 0px 0 #ffffff, 0px -1px 0 #ffffff, 1px 1px 1px rgba(70, 206, 0, 0);
    /* color: red; */
    font-weight: bold;
    /* font-family: cursive; */
    background: none;
    /* background-color: white; */
    border: none;
    /* border-color: black; */
    box-shadow: none;
    cursor: none;
    /* margin: ; */
}
   </style>
</head>
<body>
<div id="map" style="width:500px;height:400px;"></div>
<a id="marker_1" href="#">Marker 1</a>
<br>
<a id="marker_2" href="#">Marker 2</a>
<br>
<a id="marker_3" href="#">Marker 3</a>

<script>
var map = L.map('map').setView([51.49, 0.0911], 15);
var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var osmLayer = new L.TileLayer(osmUrl, {
  maxZoom: 19,
  attribution: 'Map data © OpenStreetMap contributors'
});
map.addLayer(osmLayer);

//this section sets the behavior of the markers themselves
var marker1 = L.marker([51.49, 0.0911], {
  title: "marker_1"
}).addTo(map).bindPopup("Marker 1").on('click', clickZoom).bindTooltip('555', {permanent: true,
            direction: 'bottom',
            offset: [0, 20],
            interactive: false,
            opacity: 15,
            className: 'tooltip-realtime',});
var marker2 = L.marker([51.49, 0.0914], {
  title: "marker_2"
}).addTo(map).bindPopup("Marker 2").on('click', clickZoom).bindTooltip('666',{permanent: true,
            direction: 'bottom',
            offset: [0, 20],
            interactive: false,
            opacity: 15,
            className: 'tooltip-realtime',});
var marker3 = L.marker([51.49, 0.0917], {
  title: "marker_3"
}).addTo(map).bindPopup("Marker 3").on('click', clickZoom).bindTooltip('777',{permanent: true,
            direction: 'bottom',
            offset: [0, 20],
            interactive: false,
            opacity: 15,
            className: 'tooltip-realtime',});

function clickZoom(e) {
	map.setView(e.target.getLatLng(),15);
}

//everything below here controls interaction from outside the map
var markers = [];
markers.push(marker1);
markers.push(marker2);
markers.push(marker3);


function markerFunction(id) {
  for (var i in markers) {
    var markerID = markers[i].options.title;
    var position = markers[i].getLatLng();
    console.log(markerID)
    if (markerID == id) {
    	map.setView(position, 15);
      markers[i].setZIndexOffset(1000).openPopup().openTooltip();
      console.log(markers[i]);
    }else{
    	map.setView(position, 15);
      markers[i].setZIndexOffset(0);
    };
  }
}

$("a").click(function() {
  markerFunction($(this)[0].id);
});
</script>
</body>
</html>