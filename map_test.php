<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="crossorigin=""></script>
</head>
<body>
  <?php
  include("config.php");
  $sql="SELECT * FROM positions";
  $result=$conn->query($sql);
  ?>

  <div id="map" style="width : 66.66vw; height: 90vh;"></div>
<style media="screen">
.myCSSClass {
font-size: 20px;
color: red;
font-weight: bold;
background: none;
/* background-color: none; */
border: none;
/* border-color: none; */
box-shadow: none;
cursor: none;
margin: 0;
}
.leaflet-tooltip-bottom:before{
    border: none;
}
</style>
  <script>
var popup = L.popup();
var mymap = L.map('map').setView([18.796678, 98.981099], 18);


var OpenStreetMap_HOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
  maxZoom: 20,
  foo: 'map',
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
}).addTo(mymap);

     var LeafIcon = L.Icon.extend({
          options: {
              iconSize: [100, 100],
              iconAnchor: [50, 50]
          }
      });

      var LeafIcon1 = L.Icon.extend({
          options: {
              iconSize: [29, 29],
              iconAnchor: [15, 15],
              popupAnchor: [0, -7]
          }
      });
      <?php
        while ($rs=$result->fetch_assoc()) {
      ?>

      var markIcon = new LeafIcon({iconUrl: 'images/mark_on2.png'}),
          carIcon = new LeafIcon1({iconUrl: 'images/<?= $rs['type_img']; ?>' });

    var m = L.marker([<?= $rs['lat'] ?>, <?= $rs['lng'] ?>], {icon: markIcon,rotationAngle: 0 ,rotationOrigin: 'center center'}).addTo(mymap);
    var m = L.marker([<?= $rs['lat'] ?>, <?= $rs['lng'] ?>], {icon: carIcon}).addTo(mymap).bindPopup('Device : <?= $rs['device']?> <br> Speed : <?= $rs['speed']?> <br> Address : <?= $rs['address'] ?>')
    .bindTooltip("<?= $rs['device'] ?>" ,{permanent: true ,direction: 'bottom' , offset:[0,30] ,interactive: true ,opacity: 10, className :'myCSSClass' })
    .openTooltip();
    <?php
  }
  ?>

  mymap.on('popupopen', function(centerMarker) {
          var cM = mymap.project(centerMarker.popup._latlng);
          cM.y -= centerMarker.popup._container.clientHeight/
          mymap.setView(mymap.unproject(cM),20, {animate: true});
      });



    </script>
</body>
</html>
