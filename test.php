    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>

    <style>
    #map {
        margin: 0;
        width: 100%;
        height: 100%;
}
</style>

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
}).addTo(map).bindPopup("Marker 1").on('click', clickZoom).bindTooltip('555').openTooltip();
var marker2 = L.marker([51.49, 0.0914], {
  title: "marker_2"
}).addTo(map).bindPopup("Marker 2").on('click', clickZoom).bindTooltip('555').openTooltip();
var marker3 = L.marker([51.49, 0.0917], {
  title: "marker_3"
}).addTo(map).bindPopup("Marker 3").on('click', clickZoom).bindTooltip('555').openTooltip();

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
      markers[i].setZIndexOffset(1000);
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