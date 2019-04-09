<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="crossorigin=""/>
    <!-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.0/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="js/leaflet.css" /> -->
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="crossorigin=""></script>
    <!-- <script type='text/javascript' src='js/jquery-3.3.1.min.js'></script>
    <script type='text/javascript' src='js/leaflet.markercluster.js'></script>
    <script src="js/leaflet.js"></script> -->
    <style type="text/css">
        #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height:100%;
            width: 66.666vw;
        }
    </style>
</head>
<script type="text/javascript">
    var theme = "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png";
    var lat = 13.76498;
    var lon = 100.538335;
    var alt =481;
    var macarte = null;
    //var trace = new Array();
    var i = 0;
    //var marker1;
    var markerClusters; // Servira à stocker les groupes de marqueurs
    var popup = L.popup();
  function initMap(){

      // Nous définissons le dossier qui contiendra les marqueurs
      //var iconBase = 'img';
      // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
      macarte = L.map('map').setView([lat, lon], 15);
      markerClusters = L.markerClusterGroup; // Nous initialisons les groupes de marqueurs
      // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
      L.tileLayer(theme, {

          }).addTo(macarte);
      macarte.on('click', onMapClick);
  }
    function onMapClick(e) {
        popup

            .setLatLng(e.latlng)
            .setContent("You clicked the map at " )
            .openOn(macarte);

        var marker = L.marker(e.latlng).addTo(macarte)
    }
    $(document).ready(function(){
        initMap();
    });
</script>
<div id="map">
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>
</div>

<body>



</body>

</html>
