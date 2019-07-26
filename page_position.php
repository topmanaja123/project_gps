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
        height: 100vh;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .margin-form {
        margin-left: 10px;
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

    .lockH {
        height: 100vh;
    }

    .marginMap{
        margin : 0;
        padding : 0;
    }
    </style>
</head>

<script>
//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $("#sc").val();

    // console.log("Debug : " + sc);
    $.ajax({
        url: "getPositions.php",
        type: "POST",
        data: {
            data: sc
        },

        success: function(result) {
            // console.log(result)
            var data2 = '';
            var obj = jQuery.parseJSON(result);
            if (obj != '') {
                //$("#myTable tbody tr:not(:first-child)").remove();
                $("#myBody").empty();
                markers.clearLayers();
                $.each(obj, function(key, val) {

                    // console.log(devi_name);
                    var tr = "<tr style='background-color : " + status(val["devicetime"]) + "'>";
                    tr = tr + "<td id='" + val["devi_id"] + "' onclick='myPanto(" + val["devi_id"] +
                        "," + val["lat"] + "," + val["lng"] + ")'>" + val["devi_name"] + "</td>";
                    tr = tr + "<td>" + dateTime(val["devicetime"]) + "</td>";
                    tr = tr + "<td>" + val["speed"] + "</td>";
                    tr = tr + "<td>" + "</td>";
                    tr = tr + "</tr>";
                    $('#myTable > tbody:last').append(tr);

                    data2 = {
                        'devi_id': val["devi_id"],
                        'devi_name': val["devi_name"],
                        'devi_imei': val["devi_imei"],
                        'id_position': val["id_position"],
                        'rfid_name': val["rfid_name"],
                        'rfid_number': val["rfid_number"],
                        'devicetime': val["devicetime"],
                        'servertime': val["servertime"],
                        'altitude': val["altitude"],
                        'lat': val["lat"],
                        'lng': val["lng"],
                        'speed': val["speed"],
                        'course': val["course"],
                        // 'attributes':attributes,
                        'valid': val["valid"],
                        'state': val["state"],
                        'devi_category': val["devi_category"]
                    };
                    dataRealtime(data2);
                });
                search();
            }
        }
    });
}
// setInterval(getDataFromDb, 5000); // 1000 = 1 second

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

//realtime marker
function dataRealtime(Data) {
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

// format date time
function dateTime(dateT) {
    if (dateT == "0000-00-00 00:00:00") {
        return "NOT TIME";
    } else {
        var date = new Date(dateT);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var Hours = date.getHours();
        var Minutes = date.getMinutes();
        var Seconds = date.getSeconds();
        var strTime = Hours + ':' + Minutes;
        var strDate = day + "/" + month + "/" + year;
        return strDate + '&nbsp; &nbsp;' + strTime;
    }
}
//เปลี่ยนสี สถานะรถ offline & online
function status(date) {
    if (date == "0000-00-00 00:00:00") {
        return '#FFB1B1';
    } else {
        var date1 = new Date(date);
        var date2 = new Date();

        var diff = date2.getTime() - date1.getTime();

        var msec = diff;

        var hh = Math.floor(msec / 1000 / 60 / 60);
        msec -= hh * 1000 * 60 * 60;
        var mm = Math.floor(msec / 1000 / 60);
        msec -= mm * 1000 * 60;
        var ss = Math.floor(msec / 1000);
        msec -= ss * 1000;

        if (hh == '0' && mm >= '5' || hh == '0' && mm >= '5' || hh > '0') {
            return '#FFB1B1';
        } else if (hh == '0' && mm >= '2' || hh == '0' && mm < '2'){
            return '#FFFF8D';
        }else {
            return '#BDFF73';
        }
    }
    
}

//click panto to marker
function myPanto(id, lat, lng) {
    map.setView([lat, lng], 20, {
        animate: true,
        noMoveStart: true
    });
}
</script>

<body Onload="onLoad();">
    <div class="form-row row m-0">
        <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3 lockH marginMap">
            <p>
                <form>
                    <div class="form-row margin-form" style="height : 5vh">
                        <div class="form-group mb-0 ">ค้นหาทะเบียนรถ</div>
                        <div class="form-group col mb-0">
                            <input class="form-control" type="text" id="sc" name="sc" onkeyup="getDataFromDb()"
                                placeholder="ทะเบียนรถ">
                        </div>
                    </div>
                </form>
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="style-3" style="height : 91.5vh">
                    <table class="table table-bordered table-hover table-sm" id="myTable">
                        <thead>
                            <tr class="header">
                                <th width="30%">
                                    <div align="center">ทะเบียนรถ</div>
                                </th>
                                <th width="auto">
                                    <div align="center">เชื่อมต่อล่าสุด</div>
                                </th>
                                <th>
                                    <div align="center">ความเร็ว</div>
                                </th>
                                <th>
                                    <div align="center">น้ำมัน</div>
                                </th>
                            </tr>
                        </thead>

                        <!-- body dynamic rows -->
                        <tbody id='myBody' style="cursor:pointer;">

                        </tbody>
                    </table>
                </div>
        </div>

        <div class="col-sm-6 col-md-7 col-lg-8 col-xl-9 lockH marginMap">
            <div id="map" style="height : 100vh" class="marginMap"></div>
        </div>

    </div>
    <script>
    function onLoad() {
        getDataFromDb()
        setTimeout("doLoop();", 10000);
    }

    function doLoop() {
        onLoad();
    }
    </script>
</body>

</html>

<script src="map.js"></script>
<script>
// click popup to canter
map.on('popupopen', function(centerMarker) {
    var cM = map.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight /
        map.setView(map.unproject(cM), 20, {
            markerZoomAnimation: true,
            animate: true
        });
});

// filter table
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
}
</script>