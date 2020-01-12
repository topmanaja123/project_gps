var markerGroup = L.layerGroup();
var markers = {};
// var dataArr = data2;
var arrayData = [];

var popupOption = {
    'className': 'popup-realtime',
    // 'autoPan': 'true',
    'maxWidth': '500'
}

// Realtime 10 Seconds
function onLoad() {
    getDataFromDb();  //first get data and search data
    setTimeout("goLoop();", 10000);
}

function goLoop() {
    getDataUpdate()  //update data in table
    setTimeout("doLoop();", 10000);
}
function doLoop() {
    goLoop();
}

function keySearch() {
    markerGroup.clearLayers();
    getDataFromDb();
}

//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $('#sc').val();

    // console.log("Debug : " + sc);
    $.ajax({
        url: './getData/getPositions.php',
        type: 'POST',
        data: {
            data: sc,
        },
        success: function(result) {
            var data2 = '';
            // console.log(result);
            var obj = jQuery.parseJSON(result);
            if (obj != '') {
                $('#myBody').empty();
                //$("#myTable tbody tr:not(:first-child)").remove();
                // markerGroup.hide();
                $.each(obj, function(key, val) {
                    var att = jQuery.parseJSON(val['attributes']);

                    // Realtime table list 
                    // var tr = '<tr id="tr'+val['id']+'" onclick="myPanto2(' + val['lat'] + ',' + val['lng'] + ')">';
                    // tr = tr + '<td class="col-sm-4" style="cursor:pointer;" id="t_name'+val['id']+'" >' + get_time_diff(val['devicetime']) + ' ' + val['name'] + keyCheck(att['status'], val['protocol'], att['ignition']) + '</td>';
                    // tr = tr + '<td class="col-sm-4" align="center" id="t_time'+val['id']+'">' + dateTime(val['devicetime']) + '</td>';
                    // tr = tr + '<td class="col-sm-2" align="center" id="t_speed'+val['id']+'">' + toFixed(val['speed'], 2) + " km/h" + '</td>';
                    // tr = tr + '<td class="col-sm-2" align="center" id="t_fuel'+val['id']+'">' + fuel(att['adc1'], val['protocal']) + '</td>';
                    // tr = tr + '</tr>';
                    // $('#myTable > tbody:last').append(tr);

                    var tr = '<tr id="tr'+val['id']+'" onclick="myPanto2(' + val['lat'] + ',' + val['lng'] + ',' +val['id']+')">';
                    tr = tr + '<td class="col-sm-4" style="cursor:pointer;" id="t_name'+val['id']+'" >' + val['name'] +  '</td>';
                    tr = tr + '<td class="col-sm-4" align="center" id="t_time'+val['id']+'">' + dateTime(val['devicetime']) + '</td>';
                    tr = tr + '<td class="col-sm-2" align="center" id="t_speed'+val['id']+'">' +  " km/h" + '</td>';
                    tr = tr + '<td class="col-sm-2" align="center" id="t_fuel'+val['id']+'">' + '</td>';
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

function getDataUpdate() {
    var sc = $('#sc').val();

    // console.log("Debug : " + sc);
    $.ajax({
        url: './getData/getPositions.php',
        type: 'POST',
        data: {
            data: sc,
        },
        success: function(result) {
            var data2 = '';
            // console.log(result);
            var obj = jQuery.parseJSON(result);
            if (obj != '') {

                // markerGroup.hide();
                $.each(obj, function(key, val) {
                    var att = jQuery.parseJSON(val['attributes']);

                    // viable element id 
                    let ele_trID = "tr"+val['id'];
                    let ele_nameID = "t_name"+val['id'];
                    let ele_timeID = "t_time"+val['id'];
                    let ele_speedID = "t_speed"+val['id'];
                    let ele_fuelID = "t_fuel"+val['id'];
                    
                    // console.log(ele_nameID)
                    // getelement 
                    let ele_name = document.getElementById(ele_nameID);
                    let ele_time = document.getElementById(ele_timeID);
                    let ele_speed = document.getElementById(ele_speedID);
                    let ele_fuel = document.getElementById(ele_fuelID);
                    let ele_tr = document.getElementById(ele_trID);

                    let onlineCheckValue = get_time_diff(val['devicetime'])
                    let nameValue = val['name']
                    let keyCheckValue = keyCheck(att['status'], val['protocol'], att['ignition'])
                    ele_name.innerHTML = onlineCheckValue+nameValue+keyCheckValue;

                    let datetimeValue = dateTime(val['devicetime'])
                    ele_time.innerHTML = datetimeValue;

                    let speedValue = toFixed(val['speed'], 2)
                    ele_speed.innerHTML = speedValue+" km/h";

                    let fuelValue = fuel(att['adc1'], val['protocal'])
                    ele_fuel.innerHTML = fuelValue;
                    
                    // // Realtime table list 
                    // var tr = "<tr onclick='myPanto3(" + val['lat'] + ',' + val['lng'] + ")'>";
                    // tr = tr + '<td class="col-sm-4" id=' + val[''] + 'style=cursor:pointer; >' + get_time_diff(val['devicetime']) + ' ' + val['name'] + keyCheck(att['status'], val['protocol'], att['ignition']) + '</td>';
                    // tr = tr + '<td class="col-sm-4" align="center">' + dateTime(val['devicetime']) + '</td>';
                    // tr = tr + '<td class="col-sm-2" align="center">' + toFixed(val['speed'], 2) + " km/h" + '</td>';
                    // tr = tr + '<td class="col-sm-2" align="center">' + fuel(att['adc1'], val['protocal']) + '</td>';
                    // tr = tr + '</tr>';
                    // $('#myTable > tbody:last').append(tr);

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
        isNotMarker(dataArr);
        
    } else {
        if (markers[dataArr['id']]._popup.isOpen() == true) {
            isMarkerPoi(dataArr);
            myPanto2(dataArr['lat'], dataArr['lng']);
        } else {
            isMarker(dataArr);
        }
    }
    
}

// content Marker is Not Marker 
function isNotMarker(data) {
    let dataArr = data;
    var myIcon = L.icon({
        iconUrl: 'images/show/bus.png',
        iconSize: [22, 45],
        iconAnchor: [11, 22],
        popupAnchor: [0, -7]
    });

    markers[dataArr['id']] = new L.Marker([dataArr['lat'], dataArr['lng']], {
            icon: myIcon,
            rotationAngle: dataArr['course'],
            rotationOrigin: 'center center',
            title: dataArr['id']
        }).bindPopup(
            'รายละเอียด' +
            '<br>ทะเบียน : ' +
            data['name'] +
            '<br>ความเร็ว : ' +
            toFixed(data['speed'], 2) +
            '<br>เวลา : ' +
            data['devicetime'] +
            '<br>ตำแหน่ง : ' +
            '<a href="http://www.google.com/maps/place/' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + ' " target="_blank" style="color:#515151;">' + toFixed(data['lat'], 5) + ',' + toFixed(data['lng'], 5) + '</a>' +
            '<br>ที่อยู่ : <i style="font-size:12px">เรียกข้อมูลที่อยู่.....</i>' +
            '<br>รหัสใบขับขี่ : ' +
            devLicense(data['driverLicense']) +
            '<br>เชื่อมต่อกับ : ' + connectDlt(data['connect']) + ' ' + connectPost(data['connect_post']), popupOption
        )
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
            '<br>ที่อยู่ : <i style="font-size:12px">เรียกข้อมูลที่อยู่.....</i>' +
            '<br>รหัสใบขับขี่ : ' +
            devLicense(dataArr['driverLicense']) +
            '<br>เชื่อมต่อกับ : ' + connectDlt(dataArr['connect']) + ' ' + connectPost(dataArr['connect_post'])
        );
    markerGroup.addLayer(markers[dataArr['id']]);
    // console.log(markerGroup);
}

function isMarkerPoi(data) {
    // console.log('เจอG');
    let dataArr = data;
    let latlngStr = dataArr['lat'] + ',' + dataArr['lng']
        // call geofunction 
    var address = geocodeLatLng(latlngStr, function(addr) {

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
                '<br>ที่อยู่ :' + addr +
                '<br>รหัสใบขับขี่ : ' +
                devLicense(dataArr['driverLicense']) +
                '<br>เชื่อมต่อกับ : ' + connectDlt(dataArr['connect']) + ' ' + connectPost(dataArr['connect_post'])
            );
        markerGroup.addLayer(markers[dataArr['id']]);
        
        // console.log(markerGroup);
    });
}

function onClick(e) {
    alert(e.latlng);
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
        var strTime = Hours + ":" + Minutes + ":" + Seconds;
        var strDate = day + "/" + month + "/" + year;
        return strDate + "&nbsp;&nbsp;" + strTime;
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
        //red
        return '<i class="far fa-globe" style="color : 	#f12711 "></i>';
    }
    var milisec_diff = now - datetime;

    var M = milisec_diff / 1000;
    // var date_diff = new Date(milisec_diff);
    if (M < '0') {
        //orange
        return '<i class="fad fa-circle fa-lg" style="color : #FFA500 "></i>';
    } else if (M >= '0' && M < '300') {
        //green
        return '<i class="fad fa-circle fa-lg" style="color : #0ca703 "></i>';
    } else if (M > '300' && M <= '600') {
        //yellow
        return '<i class="fad fa-circle fa-lg" style="color : #FFD700 "></i>';
    } else if (M > '600') {
        //red
        return '<i class="fad fa-circle fa-lg" style="color : #f12711 "></i>';
    }
    // console.log(M);
}

function fuel(fuelid, proname) {

    var fuelMax = 100; //น้ำมันเต็ม
    var fuelV = 215; //ค่าโวลต์ ต่ำสุด ที่น้ำมัน 0%
    var fuelUse = fuelid / fuelV * fuelMax; //คำนวณค่าน้ำมันที่ใช้ไป
    var fueltotal = 100 - fuelUse; //ผลลัพ ค่าน้ำมันเป็น เปอร์เซน
    if (proname == 'meiligao') {
        if (isNaN(fuelid)) {
            return '';
        } else if (fuelid == '0') {
            return ' ';
        } else if (fuelid == '0000') {
            return fueltotal.toFixed(2) + ' %';
        } else {
            return fueltotal.toFixed(2) + ' %';
        }
    } else {
        return '';
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
function myPanto(lat, lng) {
    let zoom = 13;
    map.setView([lat, lng], zoom, {
        animate: true,
        noMoveStart: true
    });
    map.closePopup();
}

function myPanto2(lat, lng, id) {
    let zoom = 13;
    if (map.getZoom() > 13) {
        zoom = map.getZoom();
    }
    for (var i in markers) {
    var markerID = markers[i].options.title;
    // console.log(position)
        if (markerID == id) {
            map.setView([lat, lng], zoom);
            markers[i].setZIndexOffset(1000);
            // console.log('1');  
            // console.log( markers[i]);  
        }else{
            map.setView([lat, lng], zoom);
            markers[i].setZIndexOffset(0);
            // console.log('2');  
            // console.log( markers[i]);    
        }
}
  
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