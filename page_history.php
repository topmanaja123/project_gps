<html>

<head>
    <!-- bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> -->

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <link rel="stylesheet" href="vendor/Lightpick/css/lightpick.css">

    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>
    <script rel="stylesheet" src="js/polyline/leaflet.polylineDecorator.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/th.js"
        integrity="sha256-p2W93O+vSx9WeMoysQcwoOkbExKS/gISb+muTjcgQDA=" crossorigin="anonymous"></script>
    <script src="vendor/Lightpick/lightpick.js"></script>

    <style media="screen">
    .bg-green {
        background-color: #e2e2e2;
    }

    .full-block {
        height: 90vh;
        width: 100vw;
    }

    .my-custom-scrollbar {

        position: relative;
        height: 660px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
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

    #style-3::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 1);
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar-thumb {
        background-color: #46ff46;
    }
    </style>

</head>

<body>
    <?php
    require "config.php";
    $sql = "SELECT `devices`.* FROM `devices`";
    $result = $conn->query($sql);
    ?>

    <?php
if (isset($_POST['serach'])) {

    $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[dev_id] AND fixtime BETWEEN '$_POST[date_start]' AND '$_POST[date_end]'";
    $resultPosition = $conn->query($sqlPosition);
    $resultNums=$resultPosition->num_rows;
    $resultPositionLine = $conn->query($sqlPosition);
    // echo $resultNums;
    }
    ?>
    <div class="row">
        <div class="col-3">
            <div class="form-row">
                    <div class="form-group col-md-3 col-lg-4 text-right align-self-center">
                        เลือกวันที่
                    </div>
                    <div class="form-group col-sm-12 col-md-9 col-lg-8">
                        <input class="form-control" type="text" id="datepicker" readonly>
                    </div>

                <div class="col-md-12 col-lg-12 text-center">
                    <p id="resultDate"></p>
                </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="style-3">
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
                        if (isset($resultPosition)) {
                            while ($rs1 = $resultPosition->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="text-center" width="5%"><input type="checkbox" name="checkboxList"></td>
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

<script src="map.js"></script>
<!-- scrip map -->
<script>
var picker = new Lightpick({
    field: document.getElementById('datepicker'),
    singleDate: false,
    onSelect: function(start, end) {
        var str = '';
        str += start ? start.format('[ Do MMMM YYYY') + ' ถึง ' : '';
        str += end ? end.format('Do MMMM YYYY ]') : '...';
        document.getElementById('resultDate').innerHTML = str;
    }
});

//icon
var LeafIcon = L.Icon.extend({
    options: {
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    }
});

var arrow = new LeafIcon({
    iconUrl: 'images/arrow.svg'
});

//polyline
var latlng = [];
var latlngStr = "";
// var show = [ ];
let countx = 0;
<?php
if (isset($resultPositionLine)) {
    
    while ($resultPolyline = $resultPositionLine->fetch_assoc()) {
    
        ?>
countx = countx + 1;
latlngStr = [<?= $resultPolyline['latitude']?>, <?= $resultPolyline['longitude']?>];
latlng.push(latlngStr);

var marker = L.marker(latlngStr, {
    icon: arrow,
    rotationAngle: <?=$resultPolyline['course']?>,
    rotationOrigin: 'center center'
}).addTo(map);


<?php
}//while($resultPolyline = $resultPositionLine->fetch_assoc()) {
    ?>
console.log(countx);
<?php
} //if($resultPositionLine){
?>


var showLine = [latlng];
var polyline = L.polyline(showLine, {
    color: 'red'
}).addTo(map); //show polyline

$(document).ready(function() {
    $('.select2').select2();
});
</script>
<script>
$('input[name="dates"]').daterangepicker();
</script>