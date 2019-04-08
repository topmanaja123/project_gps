<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link href="vender/select2/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="vender/select2/css/select2-bootstrap4.css" type="text/css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
  <link rel="stylesheet" type="text/css" href="css/style_positions.css">
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
  <script src="js/leaflet-realtime.js"></script>
  <script rel="stylesheet" src="js/leaflet.rotatedMarker.js">

  </script>
</head>
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
  .leaflet-tooltip-bottom:before {
    border: none;
  }
</style>

<body>
  <?php
  include("config.php");
  $sql="SELECT
      `devices`.`devi_id`,
      `devices`.`devi_name`,
      `devices`.`devi_imei`,
      `positions`.`posi_id`,
      `positions`.`devicetime`,
      `positions`.`servertime`,
      `positions`.`fixtime`,
      `positions`.`lat`,
      `positions`.`lng`,
      `positions`.`speed`,
      `positions`.`course`,
      `positions`.`rf_name`,
      `positions`.`rf_number`,
      `devices`.`devi_model`,
      `category`.`cate_id`,
      `category`.`cate_name`,
      `category`.`cate_pic`,
      `devices`.`devi_fuel`,
      `devices`.`devi_utc`,
      `devices`.`connect_dlt`,
      `devices`.`connect_post`,
      `devices`.`connect_acc`
  FROM
      `category`
      INNER JOIN `devices` ON `category`.`cate_id` = `devices`.`devi_category`
      INNER JOIN `positions` ON `positions`.`posi_id` = `devices`.`devi_position`";
      $result=$conn->query($sql);
      $result1=$conn->query($sql);
  ?>
  <div class="col-sm-3">
    <table class="table table-sm table-bordered">
      <thead>
        <tr>
          <th>header</th>
        </tr>
      </thead>
      <?php
      $i = 0;
          while($rs=$result->fetch_assoc()){
      $i++;
      ?>
      <tbody>
        <tr>
          <td id="<?= $i ?>" style="cursor:pointer;"><?= $rs['devi_name'] ?></td>
        </tr>
      </tbody>
      <?php
        }
      ?>
    </table>
  </div>
  <div class="map col-sm-9">
    <div id="map" style="width : 75vw; height: 90vh;"></div>
  </div>
</body>
</html>
<script>
  var popup = L.popup();
  var mymap = L.map('map').setView([18.796678, 98.981099], 18) ;

// map
  L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
  }).addTo(mymap);

//realtime
var realtime = L.realtime({
  url: '../json/data.json',
  crossOrigin: true,
  type: 'json',

},{
  interval: 3000,

}).addTo(mymap);

realtime.on('update', function() {
    map.fitBounds(realtime.getBounds(), {maxZoom: 5});
});

//zoom add a scale at at your map.
var scale = L.control.scale().addTo(mymap);

// icon
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

//marker
  var markers = [];
      <?php
        $s = 0;
        while($rs1=$result1->fetch_assoc()) {
        $s++;
      ?>

      // document.write(<?= $s ;?>);
  var greenIcon = new LeafIcon({ iconUrl: 'images/mark_on2.png' }),
      redIcon = new LeafIcon1({iconUrl: 'images/<?= $rs1["cate_pic"] ?>'});

      L.marker([<?= $rs1['lat'] ?>,<?= $rs1['lng'] ?>], {icon: greenIcon, rotationAngle: <?= $rs1['course']?> ,rotationOrigin: 'center center'}).bindPopup('Device : <?= $rs1['devi_name']?> <br> Speed : <?= $rs1['speed']?> ').addTo(mymap);
      var markers1 = L.marker([<?= $rs1['lat'] ?>, <?= $rs1['lng'] ?>], {title:"<?= $s ;?>", icon: redIcon}).addTo(mymap).bindPopup('Device : <?= $rs1['devi_name']?> <br> Speed : <?= $rs1['speed']?> ')
      .bindTooltip("6666", {permanent: true,direction: 'bottom',offset: [0, 30],interactive: true,opacity: 10,className: 'myCSSClass'}).openTooltip();
      markers.push(markers1);
      <?php
      }
      ?>
      function clickZoom(e) {
      	mymap.setView(e.target.getLatLng(),15);
      }

      function markerFunction(id) {
        for (var i in markers) {
          var markerID = markers[i].options.title;
          var position = markers[i].getLatLng();
          if (markerID == id) {
            mymap.setView(position, 20);
            markers[i].openPopup();
          };
        }
      }
      $("td").click(function() {
        markerFunction($(this)[0].id);
      });
      mymap.on('popupopen', function(centerMarker) {
        var cM = mymap.project(centerMarker.popup._latlng);
        cM.y -= centerMarker.popup._container.clientHeight /
          mymap.setView(mymap.unproject(cM), 20, {
            markerZoomAnimation: true
          });
      });



</script>
