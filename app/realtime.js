var markerGroup = L.layerGroup();

var markers = {};
// var dataArr = data2;
var arrayData = [];

var popupOption = {
    'className': 'popup-realtime',
    'autoPan': 'true',
    'maxWidth': '500'

}

//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $('#sc').val();

    // console.log("Debug : " + sc);
    $.ajax({
        url: './getPositionsT.php',
        type: 'POST',
        data: {
            data: sc,
        },
        success: function(result) {
            var data2 = '';
            var obj = jQuery.parseJSON(result);
            if (obj != '') {
                //$("#myTable tbody tr:not(:first-child)").remove();
                $('#myBody').empty();
                // markerGroup.hide();
                $.each(obj, function(key, val) {
                    var att = jQuery.parseJSON(val['attributes']);

                    // Realtime table list 
                    var tr = "<tr style='background-color : " + get_time_diff(val['devicetime']) + "'>";
                    tr = tr + "<td id='" + val[''] + "' onclick='myPanto(" + val['devi_id'] + ',' + val['lat'] +
                        ',' + val['lng'] + ")' style=cursor:pointer; >" + val['name'] + keyCheck(att['status'], val['protocol'], att['ignition']) + '</td>';
                    tr = tr + '<td align="center">' + dateTime(val['devicetime']) + '</td>';
                    tr = tr + '<td align="center">' + toFixed(val['speed'], 2) + '</td>';
                    tr = tr + '<td align="center">' + fuel(att['adc1']) + '</td>';
                    tr = tr + '</tr>';
                    $('#myTable > tbody:last').append(tr);


                    data2 = {
                        id: val['id'],
                        name: val['name'],
                        uniqueid: val['uniqueid'],
                        positionid: val['positionid'],
                        // 'rfid_name': val["rfid_name"],
                        driverLicense: val['driverLicense'],
                        devicetime: val['devicetime'],
                        protocol: val['protocol'],
                        servertime: val['servertime'],
                        fixtime: val['fixtime'],
                        attributes: att['attributes'],
                        lat: val['lat'],
                        lng: val['lng'],
                        speed: val['speed'],
                        course: val['course'],
                        // attributes: val['attributes'],
                        connect: val['connect'],
                        connect_post: val['connect_post'],
                        connect_acc: val['connect_acc'],
                        valid: val['valid'],
                        // 'state': val["state"],
                        photo: val['photo']
                    };
                    // console.log(val['protocol']);
                    dataRealtime(data2);

                });

                search();
                markerGroup.addTo(map);
            }
        },
    });
}
// setInterval(getDataFromDb, 5000); // 1000 = 1 second


//realtime marker
function dataRealtime(dataArr) {

    if (!markers.hasOwnProperty(dataArr['id'])) {
        isNotMarker(dataArr)
    } else {
        if (markers[dataArr['id']]._popup.isOpen() == true) {
            isMarkerPoi(dataArr)
        } else {
            isMarker(dataArr)
        }
    }
    // console.log(setLatLng);
}


// content Marker is Not Marker 
function isNotMarker(data) {
    let dataArr = data;
    var myIcon = L.icon({
        iconUrl: 'images/show/bus.png',
        iconSize: [22, 45],
        iconAnchor: [11, 22],
        popupAnchor: [0, -7],
    });

    markers[dataArr['id']] = new L.Marker([dataArr['lat'], dataArr['lng']], {
            icon: myIcon,
            rotationAngle: dataArr['course'],
            rotationOrigin: 'center center'
        })
        .bindPopup(
            'รายละเอียด' +
            '<br>ทะเบียน : ' +
            data['name'] +
            '<br>ความเร็ว : ' +
            toFixed(data['speed'], 2) +
            '<br>เวลา : ' +
            data['devicetime'] +
            '<br>ตำแหน่ง : ' +
            '<a href="http://www.google.com/maps/place/' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + '</a>' +
            '<br>ที่อยู่ :' +
            '<br>รหัสใบขับขี่ : ' +
            devLicense(data['driverLicense']) +
            '<br>เชื่อมต่อกับ : ' + connectDlt(data['connect']) + ' ' + connectPost(data['connect_post']) + '<br><table><tr><td>Cell 1</td><td>Cell 2</td></tr></table>', popupOption
        ).on("click", function(e) {
            clickMarker(e, dataArr)
        })
        .bindTooltip(dataArr['name'], {
            permanent: true,
            direction: 'bottom',
            offset: [0, 20],
            interactive: false,
            opacity: 15,
            className: 'tooltip-realtime',
        })
        .openTooltip();
    markers.id = dataArr['id'];

    markers[dataArr['id']].previousLatLngs = [];
    markerGroup.addLayer(markers[dataArr['id']]);
}

function isMarker(data) {
    let dataArr = data;
    markers[dataArr['id']].previousLatLngs.push(markers[dataArr['id']].getLatLng());
    markers[dataArr['id']].setLatLng([dataArr['lat'], dataArr['lng']]).setRotationAngle(dataArr['course'])
        .bindPopup(
            'รายละเอียด' +
            '<br>ทะเบียน : ' +
            dataArr['name'] +
            '<br>ความเร็ว : ' +
            toFixed(dataArr['speed'], 2) +
            '<br>เวลา : ' +
            dataArr['devicetime'] +
            '<br>ตำแหน่ง : ' +
            '<a href="http://www.google.com/maps/place/' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + '</a>' +
            '<br>รหัสใบขับขี่ : ' +
            devLicense(dataArr['driverLicense']) +
            '<br>เชื่อมต่อกับ : ' + connectDlt(dataArr['connect']) + ' ' + connectPost(dataArr['connect_post'])
        )
    markerGroup.addLayer(markers[dataArr['id']]);
}

function isMarkerPoi(data) {
    let dataArr = data;
    let latlngStr = dataArr['lat'] + ',' + dataArr['lng']
        // call geofunction 
    var address = geocodeLatLng(latlngStr, function(addr, place) {
        markers[dataArr['id']].previousLatLngs.push(markers[dataArr['id']].getLatLng());
        markers[dataArr['id']].setLatLng([dataArr['lat'], dataArr['lng']]).setRotationAngle(dataArr['course'])
            .bindPopup(
                'รายละเอียด' +
                '<br>ทะเบียน : ' +
                dataArr['name'] +
                '<br>ความเร็ว : ' +
                toFixed(dataArr['speed'], 2) +
                '<br>เวลา : ' +
                dataArr['devicetime'] +
                '<br>ตำแหน่ง : ' +
                '<a href="http://www.google.com/maps/place/' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + '</a>' +
                '<br>ที่อยู่ :' + place + '** **' + addr +
                '<br>รหัสใบขับขี่ : ' +
                devLicense(dataArr['driverLicense']) +
                '<br>เชื่อมต่อกับ : ' + connectDlt(dataArr['connect']) + ' ' + connectPost(dataArr['connect_post'])
            )
        markerGroup.addLayer(markers[dataArr['id']]);
    });
}

function clickMarker(e, data) {
    let dataArr = data;
    let latlngStr = dataArr['lat'] + ',' + dataArr['lng']
        // call geofunction 
    var address = geocodeLatLng(latlngStr, function(addr, place) {
        markers[dataArr['id']].previousLatLngs.push(markers[dataArr['id']].getLatLng());
        markers[dataArr['id']].setLatLng([dataArr['lat'], dataArr['lng']]).setRotationAngle(dataArr['course'])
            .bindPopup(
                'รายละเอียด' +
                '<br>ทะเบียน : ' +
                dataArr['name'] +
                '<br>ความเร็ว : ' +
                toFixed(dataArr['speed'], 2) +
                '<br>เวลา : ' +
                dataArr['devicetime'] +
                '<br>ตำแหน่ง : ' +
                '<a href="http://www.google.com/maps/place/' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(dataArr['lat'], 5) + ',' + toFixed(dataArr['lng'], 5) + '</a>' +
                '<br>ที่อยู่ :' + place + '** **' + addr +
                '<br>รหัสใบขับขี่ : ' +
                devLicense(dataArr['driverLicense']) +
                '<br>เชื่อมต่อกับ : ' + connectDlt(dataArr['connect']) + ' ' + connectPost(dataArr['connect_post'])
            )
        markerGroup.addLayer(markers[dataArr['id']]);
    });
}

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
        var strTime = Hours + ":" + Minutes + ":" + Seconds;
        var strDate = day + "/" + month + "/" + year;
        return strDate + "&nbsp; &nbsp;" + strTime;
    }
}

//เปลี่ยนสี สถานะรถ offline & online
function get_time_diff(datetime) {
    var datetime = new Date(datetime).getTime();
    var now = new Date().getTime();
    //55555
    if (isNaN(datetime)) {
        // console.log("N");
        return '';
    }

    if (datetime == '0000-00-00 00:00:00') {
        // console.log("dd");
        return '#FFB1B1';
    }

    var milisec_diff = now - datetime;

    var M = milisec_diff / 1000;
    // var date_diff = new Date(milisec_diff);
    if (M < '0') {
        return '#fdb14a';
    } else if (M >= '0' && M < '300') {
        return '#BDFF73';
    } else if (M > '300' && M <= '600') {
        return '#FFFF8D';
    } else if (M > '600') {
        return '#FFB1B1';
    }

    // console.log(M);
}


function fuel(fuelid) {

    var fuelMax = 100; //น้ำมันเต็ม
    var fuelV = 215; //ค่าโวลต์ ต่ำสุด ที่น้ำมัน 0%
    var fuelUse = fuelid / fuelV * fuelMax; //คำนวณค่าน้ำมันที่ใช้ไป
    var fueltotal = 100 - fuelUse; //ผลลัพ ค่าน้ำมันเป็น เปอร์เซน

    if (isNaN(fuelid)) {
        return '';
    } else if (fuelid == '0') {
        return ' ';
    } else if (fuelid == '0000') {
        return fueltotal.toFixed(2) + ' %';
    } else {
        return fueltotal.toFixed(2) + ' %';
    }
}

function devLicense(licenseid) {
    var result = '';
    if (licenseid == null) {
        return '';
    } else if (licenseid.length == 112) {
        licenseid = licenseid.substr(49, 41);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 115) {
        licenseid = licenseid.substr(49, 44);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 110) {
        licenseid = licenseid.substr(49, 39);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 63) {
        licenseid = licenseid.substr(0, 41);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 41) {
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 65) {
        licenseid = licenseid.substr(3, 41);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else if (licenseid.length == 70) {
        licenseid = licenseid.substr(5, 44);
        result = licenseid.replace(/\s+/g, ' ');
        return result
    } else {
        licenseid = licenseid.split(' ');
        license = licenseid.slice(3, 59);
        result = license.toString().replace(/,+/g, ' ');
        return result
    }
}

function connectDlt(conDlt) {
    if (conDlt == '1') {
        return '<img src="./images/connect/dlt.png" height="25" width="25">';
    } else {
        return ' ';
    }
}

function connectPost(conPost) {
    if (conPost == '1') {
        return '<img src="./images/connect/post.jpg" height="25" width="25"></img>';
    } else {
        return ' ';
    }
}

//click panto to marker
function myPanto(id, lat, lng) {
    map.setView([lat, lng], 16, {
        animate: true,
        noMoveStart: true
    });
    map.closePopup();
}

// Realtime 10 Seconds
function onLoad() {
    getDataFromDb();
    setTimeout("doLoop();", 10000);
}

function doLoop() {
    onLoad();
}

function keySearch() {
    markerGroup.clearLayers();
    getDataFromDb();
}

function keyCheck(statusKey, namePoto, proGt06) {

    if (namePoto == 'meiligao') {

        if (typeof statusKey == 'undefined') {
            return ' ';
        } else if (statusKey == '2000') {
            return ' ';
        } else if (statusKey == '2400') {
            return ' <i class="fas fa-key"></i>';
        } else if (statusKey == '6400') {
            return ' <i class="fas fa-key"></i>';
        } else {
            return ' ';
        }

    } else if (namePoto == 'meitrack') {
        if (typeof statusKey == 'undefined') {
            return ' ';
        } else if (statusKey == '0000') {
            return ' ';
        } else if (statusKey == '0400') {
            return ' <i class="fas fa-key"></i>';
        } else {
            return ' ';
        }

    } else if (namePoto == 'h02') {
        if (typeof statusKey == 'undefined') {
            return ' ';
        } else if (statusKey == '4294949887') {
            return ' ';
        } else if (statusKey == '4294942719') {
            return ' <i class="fas fa-key"></i>';
        } else {
            return ' ';
        }

    } else if (namePoto == 'gt06') {
        if (typeof proGt06 == 'undefined') {
            return ' ';
        } else if (proGt06 == 'false') {
            return ' ';
        } else if (proGt06 == 'true') {
            return ' <i class="fas fa-key"></i>';
        } else {
            return ' ';
        }
    } else {
        return ' ';
    }

}

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

function toFixed(num, pre) {
    num *= Math.pow(10, pre);
    num =
        (Math.round(num, pre) + (num - Math.round(num, pre) >= 0.5 ? 1 : 0)) /
        Math.pow(10, pre);
    return num.toFixed(pre);
}

function getaddress(data) {
    return data;
}

function geocodeLatLng(datalatlng, fnaddr, fnplace) {
    var addr = ''
    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + datalatlng + '&key=' + key, function(dataAddr) {
        return fnaddr(dataAddr.results[0].formatted_address)
    });
    // $.getJSON('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' + datalatlng + '&radius=500&key=' + key, function(dataPlace) {
    //     console.log(dataPlace);
    //     // return fnplace(dataPlace.results[0].formatted_address)
    // });
}




function getContentPoi(data) {
    let latlngstr = data['lat'] + ',' + data['lng'];
    data['lng'];
    'รายละเอียด' +
    '<br>ทะเบียน : ' +
    data['name'] +
        '<br>ความเร็ว : ' +
        toFixed(data['speed'], 2) +
        '<br>เวลา : ' +
        data['devicetime'] +
        '<br>ตำแหน่ง : ' +
        '<a href="http://www.google.com/maps/place/' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + '</a>' +
        '<br>ที่อยู่ :' + geocodeLatLng(latlngstr) +
        '<br>รหัสใบขับขี่ : ' +
        devLicense(data['driverLicense']) +
        '<br>เชื่อมต่อกับ : ' + connectDlt(data['connect']) + ' ' + connectPost(data['connect_post'])
}