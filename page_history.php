<html>

<head>
    <!-- bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> -->

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
    <link rel="stylesheet" href="vendor/Lightpick/css/lightpick.css">
    <link rel="stylesheet" href="css/mystyle.css">

    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>
    <script rel="stylesheet" src="js/polyline/leaflet.polylineDecorator.js"></script>
    <script src="js/moment.js"></script>
    <script src="vendor/Lightpick/lightpick.js"></script>
    <script src="app/history.js"></script>

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
    // date_default_timezone_set("Asia/Bangkok");
    if (isset($_POST['serach'])) {
        $dateRange = $_POST['dateRange'];
        $dateRangeArr = explode("-", $dateRange);

        $dateStart = trim($dateRangeArr['0']);
        $dateEnd = trim($dateRangeArr['1']);


        // Creating time from given date
        echo $dateStart = DateYMD($dateStart);
        echo $dateEnd = DateYMD($dateEnd);

        // // Creating new date format from that timestamp
        // $dateStart = date("Y-d-m", $dateStart);
        // // echo "--";
        // $dateEnd = date("Y-d-m", $dateEnd);


        echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";

        //Query For List Position
        $resultPosition = $conn->query($sqlPosition);

        // Query For Marker
        $resultPositionLine = $conn->query($sqlPosition);
        $resultNums = $resultPosition->num_rows;

        echo $resultNums;
    }
    ?>
    <div class="form-row">
        <div id="hisMenu" class="form-group col-3 mb-0 pb-0">
            <form action="" method="post">
                <div class="form-row pt-2 pr-3 pl-3">
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
                        <input class="form-control form-control-sm" type="text" name="dateRange" id="datepicker" readonly>
                    </div>

                    <div class="form-group col-md-12 col-lg-12 text-center mt-0 mb-0 pb-0">
                        <p id="resultDate"></p>
                    </div>
                    <div class="form-group col-md-12 col-lg-12 text-center  mt-0 mb-0 pb-0">
                        <button type="submit" name="serach">ค้นหา</button>
                    </div>
                </div>
            </form>
            <div class="table-wrapper-scroll-y my-custom-scrollbar p-0" id="style-3">
                <!-- table show data -->
                <table class="table table-bordered" BORDER="1" id="tblNeedsScrolling">
                    <thead>
                        <tr id="history_head ">
                            <td class="text-center"><i class="fas fa-check-circle"></i> </td>
                            <td class="text-center"><i class="fas fa-history"></i> </td>
                            <td class="text-center"><i class="fas fa-location-arrow"></i> </td>
                            <td class="text-center"><i class="far fa-shipping-fast"></i> </td>
                            <td class="text-center"><i class="far fa-map-marked-alt"></i> </td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($resultPosition)) {
                            // $time_start = microtime(true);
                            while ($rs1 = $resultPosition->fetch_assoc()) {
                                $latStr = number_format($rs1['latitude'], 4, '.', '');
                                $lngStr = number_format($rs1['longitude'], 4, '.', '');
                                ?>
                                <tr>
                                    <td class="text-center" width="5%"><input type="checkbox" name="checkboxList"></td>
                                    <td class="text-center" width="30%"><?= $rs1['devicetime']; ?></td>
                                    <td class="text-center" width="10%"><?= $rs1['course']; ?></td>
                                    <td class="text-center" width="10%"><?= $rs1['speed']; ?></td>

                                    <td class="text-center" width="auto" style="cursor:pointer" <?= "onclick='pantoLatLng(" . $rs1['latitude'] . "," . $rs1['longitude'] . ")'" ?>>
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
        <div id="mapBox" class="form-group col-9 mb-0 pb-0">
            <div class="card-header full-background" id="map" style="height:90vh"></div>
        </div>
    </div>
</body>

</html>
<script src="app/map.js"></script>
<!-- scrip map -->
<script>
    //click panto to marker
    function pantoLatLng(lat, lng) {
        map.setView([lat, lng], 18, {
            animate: true,
            noMoveStart: true
        });
    }

    var picker = new Lightpick({
        field: document.getElementById('datepicker'),
        singleDate: false,
        maxDays: 7,
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
    var countx = 0;
    var markers = {};
    <?php

    if (isset($resultPositionLine)) {
        while ($resultPolyline = $resultPositionLine->fetch_assoc()) {
            $attributes = json_decode($resultPolyline['attributes']);
            $statusStr = $attributes->{'status'};
            ?>
            countx = countx + 1;
            var id = <?= $resultPolyline['id'] ?>;
            // console.log(id);
            var course = <?= $resultPolyline['course'] ?>;
            var status = <?= $statusStr ?>;
            var speed = <?= $resultPolyline['speed'] ?>;
            latlngStr = [<?= $resultPolyline['latitude'] ?>, <?= $resultPolyline['longitude'] ?>];
            latlng.push(latlngStr);

            if (countx == '1') {
                var markerStart = L.marker(latlngStr, {
                    icon: arrow,
                    rotationAngle: course,
                    rotationOrigin: 'center center'
                }).addTo(map);

                markerStart.bindTooltip("Start", {
                    direction: 'top',
                    permanent: true
                }).openTooltip();
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
            var markerEnd = L.marker(latlngStr, {
                icon: arrow,
                rotationAngle: course,
                rotationOrigin: 'center center'
            }).addTo(map);

            markerEnd.bindTooltip("End", {
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

    $(document).ready(function() {
        $('.select2').select2();
    });
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> develop1
