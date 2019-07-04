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
    $.ajax({
        url: "getPositions.php",
        type: "POST",
        data: "result",

        success: function(result) {

            var data2 = '';
            var obj = jQuery.parseJSON(result);
            if (obj != '') {
                //$("#myTable tbody tr:not(:first-child)").remove();
                $("#myBody").empty();
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
                    // var attributes = val['attributes'];
                    var valid = val['valid'];
                    var state = val['state'];

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
                        'state': state
                    };

                    arrayData.push(data2);
                });
                // console.log(obj);
                search();
                // send();
                dataRealtime(arrayData);
                var myJSON = JSON.stringify(arrayData);
                // console.log(myJSON);

            }
        }
    });
}

setInterval(getDataFromDb, 5000); // 1000 = 1 second


var markers = {};
// var dataArr = data2;
var arrayData = [];

function dataRealtime(arrayData) {
    var dataArr = arrayData;
    dataArr.forEach(dataArr => {
        // console.log(dataArr['lat']+dataArr['lng'])
        if (!markers.hasOwnProperty(dataArr['devi_id'])) {
            markers[dataArr['devi_id']] = new L.Marker([dataArr['lat'], dataArr['lng']], {
                /*icon: greenIcon, rotationAngle: 0,*/
                rotationOrigin: 'center center'
            }).addTo(map).bindPopup(
                'รายละเอียด' +
                '<br>ทะเบียน : ' + dataArr['devi_name'] +
                '<br>ความเร็ว : ' + dataArr['speed'] +
                '<br>เวลา : ' + dataArr['devicetime']).bindTooltip("my tooltip text").openTooltip();
            markers[dataArr['devi_id']].previousLatLngs = [];
        } else {
            markers[dataArr['devi_id']].previousLatLngs.push(markers[dataArr['devi_id']].getLatLng());
            markers[dataArr['devi_id']].setLatLng([dataArr['lat'], dataArr['lng']]);
        }

    });
};
</script>

<body>
    <div class="form-row row">
        <div class="table-responsive col-md-3 col-sm-6">
            <p>
                <form class="form-inline" method="post">
                    <label>ค้นหา</label>
                    <div class="col">
                        <input class="form-control" type="text" id="myInput" onkeyup="search()" placeholder="ทะเบียนรถ">
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

<script>
//Map
var map = L.map('map', {
    center: [18.635346666667, 99.044695],
    zoom: 15,
    layers: [
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: 'Map data &copy; OpenStreetMap contributors',
        })
    ]
});

//zoom add a scale at your map.
var scale = L.control.scale().addTo(map);

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
    });
}
</script>
<script>
function search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
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
}
</script>