<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
 

    <style>
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 0;
        overflow: hidden;
        position: fixed;
    }

    nav {
        margin-left: -10px;
        margin-right: -10px;
    }

    .font-mar {
        margin-left: 10px;
        margin-right: -10px;
    }

    .wrapper {
        height: 100%;
        width: 100%;
        display: table;
    }

    .header,
    .content,
    .footer {
        display: table-row;
    }

    .inner {
        display: table-cell;
    }

    .content .inner {
        height: 100%;
        position: relative;
        background: pink;
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- navbar -->
        <?php
        require 'navbar/nav-route.php';
    ?>
        <!-- content -->
        <div class="content">
            <div class="inner">
                <div class="scrollable">
                    <div class="col lockH marginMap">
                        <div id="map" class="lockH"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->

        <!-- footer -->
        <?php
        require 'footer.php';
        ?>
    </div>
</body>

</html>

<script src="../app/map.js"></script>
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
        iconUrl: '../images/arrow.svg'
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
</script>
