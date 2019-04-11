    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link href="vender/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="vender/select2/css/select2-bootstrap4.css" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>
<style media="screen">
  .bg-green {
    background-color: #e2e2e2;
  }
  .select2-container--bootstrap4 .select2-selection {
      /* background-color: #fff; */
      /* outline: 0; */
      /* display: inline-block; */
      /* border: 1px solid #ced4da; */
      /* border-radius: .10rem; */
      /* width: 100%; */
      height: calc(1.8rem + 2px);
      padding: .200rem .50rem;
      line-height: 1.5;
      color: #495057;
    }
    #table-control {
      margin-top: : 10px;
    }
    #history_head {
      background-color: ;
    }
    #hr_1 {
        margin-top: 0rem;
        margin-bottom: 0rem;
        border: 0;
        border-top: 1px solid #333333;
    }
    #hr_2 {
        margin-top: -1rem;
        margin-bottom: 0rem;
        border: 0;
        border-top: 1px solid #333333;
    }
    .scrollbar{  
        height: 70% !important;
        overflow: scroll;
    }
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
  <div class="col-lg-4 col-md-12 bg-green full-block">
 </head>
<body>
  <?php
    require("config.php");
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
    if(isset($_POST['serach'])) {
    $sqlDate = "SELECT MIN(posit_mark_start) AS posi_start, MAX(posit_mark_end) AS posi_end ,device_code FROM positions_mark 
    WHERE device_code = '$_POST[dev_id]' AND posit_mark_date BETWEEN '$_POST[date_start]' AND '$_POST[date_start]'";
    $resultDate = $conn->query($sqlDate);
    $rs = $resultDate->fetch_assoc();

    $sqlPosition = "SELECT * FROM positions WHERE posi_id BETWEEN $rs[posi_start] AND $rs[posi_end] AND device_id = $rs[device_code]";
    $resultPosition = $conn->query($sqlPosition);
      echo $sqlDate;
      echo '<br>';
      echo $sqlPosition;
    }
     ?>

<div class="form-row">
    <div class="col-3">
    <!-- table control -->
    <table id="table-control" class="table table-bordered table-sm">
      <form action="" method="post">
        <tr>
          <td>
            <div class="container">
              <div class="form-row">
                <div class="col-3 text-right">
                  <span>อุปกรณ์</span>
                </div>
                <div class="col">
                  <select class="form-control form-control-sm " id="simple-single-select" name="dev_id">
                  <option selected>--เลือก--</option>
                    <?php
                    while($rs = $result->fetch_assoc()) {
                    ?>
                    <option value="<?= $rs['devi_id']; ?>"><?= $rs['devi_name']; ?></option>
                    <?php
                    } ?>
                  </select>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="container">
              <div class="form-row" >
                <div class="col-3 text-right">
                  <span>เลือกวันที่ย้อนหลัง</span>
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
                </div>
              </div>
            </div>
          </td>
        </tr>
      </form>
    </table> 
  </div>

    <hr id="hr_1">

  <div class="scrollbar">
    <!-- table list -->
    <table class="table table-bordered table-sm">
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
      if ($resultPosition){ 
        while($rs1=$resultPosition->fetch_assoc()) 
        {
        ?>
      <tr>
          <td class="text-center" width="5%"><input type="checkbox" name="checkboxList" ></td>
          <td class="text-center" width="30%"><?= $rs1['devicetime'];?></td>
          <td class="text-center" width="10%"><?= $rs1['speed'];?></td>
          <td class="text-center" width="10%"><?= $rs1['course'];?></td>
          <td></td>
          <td></td>
      </tr>
      <?php
        } //while($rs1=$result1->fetch_assoc()) 
      } //if ($result1) { 
      ?>
      </tbody>
    </table>
  </div><!--  -->
  </div>
  
   <div class="col-9">
   <div style="padding-left:0px">
    <div id="map" style="width : 66.66vw; height: 90vh;"></div>
  </div>
  
   </div>

<hr id="hr_2">
</body>


<!-- script  -->
<?php //include('js.php') ?>
<!-- scrip select2 -->
<script type="text/javascript">
  $("#simple-single-select, #simple-multiple-select, #input-group-single-select, #input-group-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4",
    placeholder: "เลือกอุปกรณ์",
    allowClear: true
  });
  $("#disabled-single-select").select2({
    width: "100%",
    theme: "bootstrap4",
    disabled: true
  });
  $("#disabled-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4",
    allowClear: true
  });
  $("#form-single-select, #form-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4"
  });
</script>
 
  <script>
  var popup = L.popup();
  var mymap = L.map('map').setView([18.796678, 98.981099], 18) ;

// map
  L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
  }).addTo(mymap);

//zoom add a scale at at your map.
var scale = L.control.scale().addTo(mymap);

//icon
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

  var greenIcon = new LeafIcon({ iconUrl: 'images/mark_on2.png' }),
      redIcon = new LeafIcon({iconUrl: 'images/ ?>'});

//polyline

var latlngs = [
    [[45.51, -122.68],
     [37.77, -122.43],
     [34.04, -118.2]],
];

//marker
L.marker([18.796678, 98.981099], {icon: greenIcon}).bindPopup('Device : <?= $rs2['devi_name'];?> <br> Speed : ').addTo(mymap);
L.marker([18.796678, 98.981099], {icon: redIcon}).addTo(mymap).bindPopup('Device : <br> Speed : ').bindTooltip("555", {permanent: true,direction: 'bottom',offset: [0, 30],interactive: true,opacity: 10,className: 'myCSSClass'}).openTooltip();
L.polyline(latlngs, {color: 'red'}).addTo(mymap);


      mymap.on('popupopen', function(centerMarker) {
        var cM = mymap.project(centerMarker.popup._latlng);
        cM.y -= centerMarker.popup._container.clientHeight /
          mymap.setView(mymap.unproject(cM), 20, {
            markerZoomAnimation: true
          });
      });
</script>

