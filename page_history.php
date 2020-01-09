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
    <link rel="stylesheet" href="css/myStyle/table-fixed.css">
    <link rel="stylesheet" href="css/myStyle/history-style.css">
    <link rel="stylesheet" href="css/myStyle/custom-scrollbars.css">

    <script src="js/moment.js"></script>
    
    <script src="vendor/Lightpick/lightpick.js"></script>
    <script src="app/history.js"></script>

    <style media="screen">
    body {
        margin: 0;
        height: 100%;
        overflow: hidden;
    }

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
    $sql = "SELECT
    `user_device`.`userid`,
    `devices`.*
  FROM
    `devices`
    INNER JOIN `user_device` ON `devices`.`id` = `user_device`.`deviceid`
    WHERE `user_device`.`userid` = $_SESSION[userid]";
    $result = $conn->query($sql);
    ?>

    <?php
    // date_default_timezone_set("Asia/Bangkok");
    if (isset($_POST['serach'])) {
        $dateRange = $_POST['dateRange'];
        $dateRangeArr = explode("-", $dateRange);
        $dateStart = trim($dateRangeArr['0']);
        $dateEnd = trim($dateRangeArr['1']);
        // Creating time from given date
        $dateStart = DateYMD($dateStart);
        $dateEnd = DateYMD($dateEnd);
        // // Creating new date format from that timestamp
        // $dateStart = date("Y-d-m", $dateStart);
        // // echo "--";
        // $dateEnd = date("Y-d-m", $dateEnd);

        $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";

        //Query For List Position
        $resultPosition = $conn->query($sqlPosition);
        $numrow = $resultPosition->num_rows;
        
        // Query For Marker
        $resultPositionLine = $conn->query($sqlPosition);
    }
    ?>
    <form class="p-0 m-0" action="" method="post">
        <div class="form-row">
            <div id="hisMenu" class="form-group col-4 mb-0 pb-0">

                <div class="form-row pt-2 pr-3 pl-3 mb-0 pb-0">

                    <div class="form-group col-md-3 col-lg-4 text-right align-self-center">
                        เลือกอุปกรณ์
                    </div>
                    <div class="form-group col-sm-12 col-md-9 col-lg-8 mb-0 pb-0">
                        <select class="form-control form-control-sm select2" name="deviceid" id="deviceid">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3 col-lg-4 text-right align-self-center">
                        เลือกวันที่
                    </div>
                    <div class="form-group col-sm-12 col-md-9 col-lg-8 mb-0 pb-0">
                        <input class="form-control form-control-sm" type="text" name="dateRange" id="datepicker"
                            required>
                    </div>

                    <div class="form-group col-md-12 col-lg-12 text-center mt-0 mb-0 pb-0">
                        <!-- <p id="resultDate"></p> -->
                    </div>
                    <div class="form-group col-md-12 col-lg-12 text-center  mt-0 mb-0 pb-0">
                        <button type="submit" name="serach">ค้นหา</button>
                    </div>
                </div>

                <div class="form-row m-0">
                    <!-- table show data -->
                    <table class="table table-striped table-fixed table-sm table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center col-1"><i class="fas fa-check-circle"></i> </th>
                                <th class="text-center col-4"><i class="fas fa-history"></i> </th>
                                <th class="text-center col-1"><i class="fas fa-location-arrow"></i> </th>
                                <th class="text-center col-2"><i class="far fa-shipping-fast"></i> </th>
                                <th class="text-center col-4"><i class="far fa-map-marked-alt"></i> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if (isset($resultPosition)) {
                            // $time_start = microtime(true);
                            while ($rs1 = $resultPosition->fetch_assoc()) {
                                $latStr = number_format($rs1['latitude'], 5, '.', '');
                                $lngStr = number_format($rs1['longitude'], 5, '.', '');
                                ?>
                            <tr>
                                <td class="text-center col-1"><input type="checkbox" name="checkboxList"></td>
                                <td class="text-center col-4"><?= $rs1['devicetime']; ?></td>
                                <td class="text-center col-2"><?= $rs1['course']; ?></td>
                                <td class="text-center col-1"><?= $rs1['speed']; ?></td>

                                <td class="text-center col-4" width="auto" style="cursor:pointer"
                                    <?= "onclick='pantoLatLng(" . $rs1['latitude'] . "," . $rs1['longitude'] . ",". $rs1['course'].")'" ?>>
                                    <?= $latStr; ?> , <?= $lngStr; ?></td>

                            </tr>
                            <?php
                            } //while($rs1=$result1->fetch_assoc())
                            // echo "Completed in ", microtime(true) - $time_start, " Seconds\n";
                            $resultPosition->close();
                        } //if ($result1) {
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 lockH marginMap">
                <div id="map" class="marginMap"></div>
            </div>
        </div>
    </form>
</body>

</html>
<script src="app/map.js"></script>
<!-- scrip map -->
<script>
//click panto to marker



var picker = new Lightpick({
    field: document.getElementById('datepicker'),
    singleDate: false,
    maxDays: 7,
    onSelect: function(start, end) {
        var str = '';
        str += start ? start.format('[ Do MMMM YYYY') + ' ถึง ' : '';
        str += end ? end.format('Do MMMM YYYY ]') : '...';
        // document.getElementById('resultDate').innerHTML = str;
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
var countx = 0;
var markers = {}; 
<?php
if (isset($resultPositionLine)) {
    while ($resultPolyline = $resultPositionLine->fetch_assoc()) {
        $attributes = json_decode($resultPolyline['attributes']);
        $statusStr = $attributes->{ 'status' }; ?>
        countx = countx + 1;
        var id = <?= $resultPolyline['id'] ?> ;
        var course = <?= $resultPolyline['course'] ?> ;
        var status = '<?= $statusStr ?>';
        var speed = <?= $resultPolyline['speed'] ?> ;
        latlngStr = [ <?= $resultPolyline['latitude'] ?> , <?= $resultPolyline['longitude'] ?> ];
        latlng.push(latlngStr);
        if (countx == '1') {
            L.marker(latlngStr, {
                icon: arrow,
                rotationAngle: course,
                rotationOrigin: 'center center'
            }).addTo(map)
            .bindTooltip("Start", {
                direction: 'top',
                permanent: true
            }).openTooltip();
        }

        if (countx != '1') {
            L.marker(latlngStr, {
                icon: arrow,
                rotationAngle: course,
                rotationOrigin: 'center center'
            }).addTo(map);
        }

        if (status == '6400' && speed != '0') {
            markers[id] = L.marker(latlngStr, {
                icon: arrow,
                rotationAngle: course,
                rotationOrigin: 'center center'
            }).addTo(map);
        } 
        <?php 
         } //while($resultPolyline = $resultPositionLine->fetch_assoc()) {
    ?>

    if (countx > '1') {
        L.marker(latlngStr, {
            icon: arrow,
            rotationAngle: course,
            rotationOrigin: 'center center'
        }).addTo(map)
       .bindTooltip("End", {
            direction: 'top',
            permanent: true
        }).openTooltip();
    }
    console.log(countx); 
    <?php
} //if($resultPositionLine){
?>
var showLine = [latlng];
var polyline = L.polyline(showLine, {
    color: 'red'
}).addTo(map); //show polyline


function pantoLatLng(lat, lng,course) {
    let zoom = 22;
    if (map.getZoom() > 15) {
        zoom = map.getZoom();
    }
    L.popup()
        .setLatLng([lat, lng])
        .setContent('รายละเอียด'+
        '<br>องศา : '+ course +
        '<br>ตำแหน่ง : ' +[toFixed(lat,5), toFixed(lng,5)])
        .openOn(map);

    map.setView([lat, lng], zoom, {
        animate: true,
        noMoveStart: true
    });
}

$(document).ready(function() {
    $('.select2').select2();
});

function toFixed(num, pre) {
    num *= Math.pow(10, pre);
    num =
        (Math.round(num, pre) + (num - Math.round(num, pre) >= 0.5 ? 1 : 0)) /
        Math.pow(10, pre);
    return num.toFixed(pre);
}
</script>