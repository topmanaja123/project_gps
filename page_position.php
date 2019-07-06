<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>

    <!-- marker -->
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>

    <!-- realtime -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/leaflet-realtime.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <title>Document</title>
    <style>
    .table {
        font-size: 14px;
    }

    .myCSSClass {
        font-size: 14px;
        color: red;
        font-weight: bold;
        font-family: cursive;
        background: none;
        /* background-color: none; */
        border: none;
        /* border-color: none; */
        box-shadow: none;
        cursor: none;
        margin: ;
    }

    .leaflet-tooltip-bottom:before {
        border: none;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 700px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    </style>
</head>

<script>
//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $("#sc").val();
    
    console.log("Debug : "+sc);
    $.ajax({
        url: "getPositions.php",
        type: "POST",
        data: {data:sc},

        success: function(result) {
            // console.log(result)
            var data2 = '';
            var obj = jQuery.parseJSON(result);
            if (obj != '') {
                //$("#myTable tbody tr:not(:first-child)").remove();
                $("#myBody").empty();
                markers.clearLayers();
                $.each(obj, function(key, val) {
                    var devi_id = val['devi_id'];
                    var devi_name = val['devi_name'];
                    var devi_imei = val['devi_imei'];
                    var id_position = val['id_position'];
                    var rfid_name = val['rfid_name'];
                    var rfid_number = val['rfid_number'];
                    var devicetime = val['devicetime'];
                    var servertime = val['servertime'];
                    var altitude = val['altitude'];
                    var lat = val['lat'];
                    var lng = val['lng'];
                    var speed = val['speed'];
                    var course = val['course'];
                    var attributes = val['attributes'];
                    var valid = val['valid'];
                    var state = val['state'];
                    var devi_category = val['devi_category'];

                    var tr = "<tr>";
                    tr = tr + "<td id='" + val["devi_id"] + "' onclick='myPanto(" + val["devi_id"] +
                        "," + val["lat"] + "," + val["lng"] + ")'>" + val["devi_name"] + "</td>";
                    tr = tr + "<td>" + val["speed"] + "</td>";
                    tr = tr + "<td>" + val["course"] + "</td>";
                    tr = tr + "<td>" + val["servertime"] + "</td>";
                    tr = tr + "</tr>";
                    $('#myTable > tbody:last').append(tr);

                    data2 = {
                        'devi_id': devi_id,
                        'devi_name': devi_name,
                        'devi_imei': devi_imei,
                        'id_position': id_position,
                        'rfid_name': rfid_name,
                        'rfid_number': rfid_number,
                        'devicetime': devicetime,
                        'servertime': servertime,
                        'altitude': altitude,
                        'lat': lat,
                        'lng': lng,
                        'speed': speed,
                        'course': course,
                        // 'attributes':attributes,
                        'valid': valid,
                        'state': state,
                        'devi_category': devi_category
                    };
                    dataRealtime(data2);
                });
                search();
            }
        }
    });
}
setInterval(getDataFromDb, 5000); // 1000 = 1 second


var markers = L.layerGroup();

var markerX = {};
// var dataArr = data2;
var arrayData = [];

var LeafIcon = L.Icon.extend({
    options: {
        iconSize: [100, 100],
        iconAnchor: [50, 50]
    }
});
var LeafIcon1 = L.Icon.extend({
    options: {
        iconSize: [29, 50],
        iconAnchor: [15, 15],
        popupAnchor: [0, -7]
    }
});

function dataRealtime(Data){
   
    var dataArr = Data;
        // console.log(dataArr['course'])
        
    
        if (!markers.hasOwnProperty(dataArr['devi_id'])) {

            var greenIcon = new LeafIcon1({
                iconUrl: 'images/top-truck.png'
            });

           markerX[dataArr['devi_id']] = new L.Marker([dataArr['lat'], dataArr['lng']], {
                icon: greenIcon,
                rotationAngle: dataArr['course'],
                rotationOrigin: 'center center'
            }).bindPopup(
                'รายละเอียด' +
                '<br>ทะเบียน : ' + dataArr['devi_name'] +
                '<br>ความเร็ว : ' + dataArr['speed'] +
                '<br>เวลา : ' + dataArr['devicetime'] +
                '<br>ตำแหน่ง : ' + dataArr['lat'] + ',' + dataArr['lng']).bindTooltip(dataArr['devi_name'], {
                permanent: true,
                direction: 'bottom',
                offset: [0, 25],
                interactive: false,
                opacity: 15
                // className: 'myCSSClass'
            }).openTooltip();
            markerX[dataArr['devi_id']].previousLatLngs = [];
            markers.addLayer(markerX[dataArr['devi_id']]);
        } else {
            markerX[dataArr['devi_id']].previousLatLngs.push(markerX[dataArr['devi_id']].getLatLng());
            markerX[dataArr['devi_id']].setLatLng([dataArr['lat'], dataArr['lng']]);
        }
        markers.addTo(map);
};




</script>

<body>
    <div class="form-row row">
        <div class="table-responsive col-md-3 col-sm-6">
            <p>
                <form class="form-inline" method="post">
                    <label>ค้นหา</label>
                    <div class="col">
                        <input class="form-control select2" type="text" id="sc" name="sc" onchange="getDataFromDb()" placeholder="ทะเบียนรถ">
                    </div>
                </form>
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
                        <thead>
                            <tr class="header">
                                <th width="40%">
                                    <div align="center">ทะเบียนรถ</div>
                                </th>
                                <th width="10%">
                                    <div align="center">ความเร็ว</div>
                                </th>
                                <th width="10%">
                                    <div align="center">ทิศทาง</div>
                                </th>
                                <th width="35%">
                                    <div align="center">เชื่อมต่อล่าสุด</div>
                                </th>
                            </tr>
                        </thead>

                        <!-- body dynamic rows -->
                        <tbody id='myBody' style="cursor:pointer;">

                        </tbody>

                    </table>
                </div>
        </div>

        <div class="col-sm-6 col-md-9">
            <div id="map" style="height:88.88vh"></div>
        </div>

    </div>
</body>

</html>
<script src="map.js"></script>
<script>
map.on('popupopen', function(centerMarker) {
    var cM = map.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight /
        map.setView(map.unproject(cM), 17, {
            markerZoomAnimation: true,
            animate: true
        });
});

//click panto to marker
function myPanto(id, lat, lng) {
    map.panTo([lat, lng], {
        animate: true,
        noMoveStart: true
    }).bindpopup();
}
</script>
<script>
function search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("sc");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    // ;
}

$(document).ready(function() {
    $('.select2').select2();
});
</script>
