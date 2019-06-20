<html>
<head>
    <!-- <link href="vender/select2/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="vender/select2/css/select2-bootstrap4.css" type="text/css" /> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>

<style media="screen">
    .bg-green {
      background-color: #e2e2e2;
    }
    .full-block{
      height: 90vh;
      width: 100vw;
    }
   .scrollbar{
      height: 450px !important;
      overflow: scroll;

    }
    .full-background {
      background: url("../img/header-image-2.jpg") 50% 0 repeat fixed;
      min-height: 800px;
      height: 800px;
      margin: 0 auto;
      width: 100%;
      max-width: 1920px;
      position: relative;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  </style>
 </head>
<body>
  <?php
require "config.php";
$sql = "SELECT
     `devices`.`devi_id`,
     `devices`.`devi_name`,
     `devices`.`devi_imei`,
     `devices`.`id_position`,
     `devices`.`rfid_name`,
     `devices`.`rfid_number`,
     `positions`.`devicetime`,
     `positions`.`servertime`,
     `positions`.`altitude`,
     `positions`.`lat`,
     `positions`.`lng`,
     `positions`.`speed`,
     `positions`.`course`,
     `positions`.`attributes`,
     `positions`.`valid`,
     `positions`.`state`
   FROM
     `devices`
      INNER JOIN `positions` ON `devices`.`id_position` = `positions`.`posi_id`";
$result = $conn->query($sql);
?>

   <?php
if (isset($_POST['serach'])) {
    $sqlDate = "SELECT MIN(posit_mark_start) AS posi_start, MAX(posit_mark_end) AS posi_end ,device_code FROM positions_mark
    WHERE device_code = '$_POST[dev_id]' AND posit_mark_date BETWEEN '$_POST[date_start]' AND '$_POST[date_start]'";
    $resultDate = $conn->query($sqlDate);
    $rs = $resultDate->fetch_assoc();
    $sqlPosition = "SELECT * FROM positions WHERE posi_id BETWEEN $rs[posi_start] AND $rs[posi_end] AND device_id = $rs[device_code]";
    $resultPosition = $conn->query($sqlPosition);
    $resultPositionLine = $conn->query($sqlPosition);
      echo $sqlDate;
    //   echo '<br>';
    echo $sqlPosition;
}
?>

<div class="form-row">
  <div class="col-3 table-responsive">
    <!-- table control -->
    <table class="table table-bordered table-sm">
    <form action="" method="post">
      <tr>
        <td>
          <div class="container-fluid">
            <div class="form-row">
              <div class="col-3 text-right">
                <span>อุปกรณ์</span>
              </div>
              <div class="col">
                <select class="form-control form-control-sm" name="dev_id">
                <option selected>--เลือก--</option>
                  <?php
                    while ($rs = $result->fetch_assoc()) {
                  ?>
                  <option value="<?=$rs['devi_id'];?>"><?=$rs['devi_name'];?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="container">
              <div class="form-row" >
                <div class="col-3 text-right">
                  <span>วันที่ย้อนหลัง</span>
                </div>
                <div class="col">
                  <input type="date" name="date_start" class=" form-control form-control-sm">
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="container">
              <div class="form-row">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-info btn-sm" type="submit" name="serach">
                    <i class="fas fa-search"></i>
                    ค้นหา
                  </button>
                  <button class="btn btn-info btn-sm" type="submit" name="print" disabled>
                  <i class="fas fa-print"></i>
                    ออกรายงาน
                  </button>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </form>
    </table>
  <div class="scrollbar">
    <!-- table show data -->
    <table class="table table-bordered table-sm" x:str BORDER="1">
      <thead>
        <tr id="history_head ">
          <td class="text-center"><i class="fas fa-check-circle"></i> </td>
          <td class="text-center"><i class="fas fa-history"></i> </td>
          <td class="text-center"><i class="fas fa-location-arrow"></i> </td>
          <td class="text-center"><i class="far fa-shipping-fast"></i> </td>
          <td class="text-center"><i class="far fa-map-marked-alt"></i> </td>
          <td class="text-center"><i class="fas fa-ban"></i> </td>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($resultPosition) {
            while ($rs1 = $resultPosition->fetch_assoc()) {
        ?>
      <tr>
          <td class="text-center" width="5%"><input type="checkbox" name="checkboxList" ></td>
          <td class="text-center" width="30%"><?=$rs1['devicetime'];?></td>
          <td class="text-center" width="10%"><?=$rs1['speed'];?></td>
          <td class="text-center" width="10%"><?=$rs1['course'];?></td>
          <td></td>
          <td></td>
      </tr>
      <?php
          } //while($rs1=$result1->fetch_assoc())
        } //if ($result1) {
      ?>
      </tbody>
    </table>
  </div>

  </div>

  <div class="col-9">
        <div class="card-header full-background" id="map" style="height:90vh"></div>
  </div>
</div>
</body>
</html>

   <!-- scrip map -->
  <script>
    var mymap = L.map('map').setView([18.635245,99.044696666667], 13);
  // map
  L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 22,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
  }).addTo(mymap);
//zoom add a scale at at your map.
var scale = L.control.scale().addTo(mymap);
//icon
var LeafIcon = L.Icon.extend({
    options: {
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    }
  });
  var greenIcon = new LeafIcon({ iconUrl: 'images/arrow.png' });

//polyline
var latlng = [ ];
var latlngStr = "";
// var show = [ ];
  <?php
  if ($resultPositionLine) {
      while ($resultPolyline = $resultPositionLine->fetch_assoc()) {
  ?>
  latlngStr = [<?=$resultPolyline['lat']?>,<?=$resultPolyline['lng']?>];
  latlng.push(latlngStr);
  // L.marker([<?=$resultPolyline['lat']?>,<?=$resultPolyline['lng']?>], {icon: greenIcon, rotationAngle: <?=$resultPolyline['course']?>, rotationOrigin: 'center center'}).addTo(mymap);
  // console.log(latlng);

  <?php
      } //while($resultPolyline = $resultPositionLine->fetch_assoc()) {
    } //if($resultPositionLine){
  ?>
  var showLine = [latlng];
  var polyline = L.polyline(showLine, {color: 'red'}).addTo(mymap); //show polyline
</script>