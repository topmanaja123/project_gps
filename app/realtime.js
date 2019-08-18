var markerGroup = L.layerGroup();

var markers = {};
// var dataArr = data2;
var arrayData = [];

var LeafIcon = L.Icon.extend({
	options: {
		iconSize: [22, 45],
		iconAnchor: [11, 22],
		popupAnchor: [0, -7],
	},
});
var LeafIcon1 = L.Icon({
	options: {
		iconSize: [22, 45],
		iconAnchor: [11, 22],
		popupAnchor: [0, -7],
	},
});

//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $("#sc").val();

	// console.log("Debug : " + sc);
	$.ajax({
		url: './getPositionsT.php',
		type: 'POST',
		data: {
			data: sc,
		},
		success: function (result) {
			// console.log(result)

			var data2 = '';
			var obj = jQuery.parseJSON(result);
			if (obj != '') {
				//$("#myTable tbody tr:not(:first-child)").remove();
				$('#myBody').empty();
				// markerGroup.hide();
				$.each(obj, function (key, val) {
					// console.log(devi_name);
					var att = jQuery.parseJSON(val['attributes']);
					var tr = "<tr style='background-color : " + get_time_diff(val['devicetime']) + "'>";
					tr =
						tr +
						"<td id='" +
						val[''] +
						"' onclick='myPanto(" +
						val['devi_id'] +
						',' +
						val['lat'] +
						',' +
						val['lng'] +
						")' style=cursor:pointer; >" +
						val['name'] +
						'</td>';
					tr = tr + '<td>' + dateTime(val['devicetime']) + '</td>';
					tr = tr + '<td>' + license(val['driverLicense']) + '</td>';
					tr = tr + '<td>' + toFixed(val['speed'], 2) + '</td>';
					tr = tr + '<td>' + fuel(att['adc1']) + '</td>';
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
						servertime: val['servertime'],
						fixtime: val['fixtime'],
						attributes: att['attributes'],
						lat: val['lat'],
						lng: val['lng'],
						speed: val['speed'],
						course: val['course'],
						// attributes: val['attributes'],
						valid: val['valid'],
						// 'state': val["state"],
						photo: val['photo'],
					};
					// var licenseZ = [];
					// 23            1            0005460  30100                     ?
					// 22            1            0008052  60602
					// ;6007641500900095877=181019880713=?+             12            1            0026558  50200                     ? *68
					// 22            1            0069961  20100                     

					var driL = [];
					driL = ";6007645660800026867=210919741003=?+             23            1            0061961  10400                     ?";
					
					var resultEx1 = driL.substr(49, 41);
					var result = resultEx1.replace(/\s+/g, ' ');
					console.log(result);

					// console.log(val['driverLicense']);
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
function dataRealtime(Data) {
    var dataArr = Data;
    // console.log(markerGroup);

	if (!markers.hasOwnProperty(dataArr['id'])) {
		// console.log("5555");
		// var car = new LeafIcon1({
		// 	iconUrl: 'images/show/bus.png'
		// });

		var myIcon = L.icon({
			iconUrl: 'images/show/bus.png',
			iconSize: [22, 45],
			iconAnchor: [11, 22],
			popupAnchor: [0, -7],
		});

		// console.log(greenIcon);
		markers[dataArr['id']] = new L.Marker([dataArr['lat'], dataArr['lng']], {
			icon: myIcon,
			rotationAngle: dataArr['course'],
			rotationOrigin: 'center center'
		})
			.bindPopup(
				'รายละเอียด' +
				'<br>ทะเบียน : ' +
				dataArr['name'] +
				'<br>ความเร็ว : ' +
				dataArr['speed'] +
				'<br>เวลา : ' +
				dataArr['devicetime'] +
				'<br>ตำแหน่ง : ' +
				toFixed(dataArr['lat'], 5) +
				',' +
				toFixed(dataArr['lng'], 5)
			)
			.bindTooltip(dataArr['name'], {
				permanent: true,
				direction: 'bottom',
				offset: [0, 20],
				interactive: false,
				opacity: 15,
				className: 'myCSSClass',
			})
			.openTooltip();
		markers.id = dataArr['id'];

		markers[dataArr['id']].previousLatLngs = [];
		markerGroup.addLayer(markers[dataArr['id']]);
		// markers.remove;
	} else {
		// console.log("fff");
		markers[dataArr['id']].previousLatLngs.push(markers[dataArr['id']].getLatLng());
		markers[dataArr['id']].setLatLng([dataArr['lat'], dataArr['lng']])
			.bindPopup(
				'รายละเอียด' +
				'<br>ทะเบียน : ' +
				dataArr['name'] +
				'<br>ความเร็ว : ' +
				dataArr['speed'] +
				'<br>เวลา : ' +
				dataArr['devicetime'] +
				'<br>ตำแหน่ง : ' +
				toFixed(dataArr['lat'], 5) +
				',' +
				toFixed(dataArr['lng'], 5)
			);
		markerGroup.addLayer(markers[dataArr['id']]);
		// markerGroup.hide(markers[dataArr["id"]]);
	}
	// console.log(setLatLng);
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
		// console.log("O");
		return '#fdb14a';
	} else if (M >= '0' && M < '300') {
		// console.log("G");
		return '#BDFF73';
	} else if (M > '300' && M <= '600') {
		// console.log("Y");
		return '#FFFF8D';
	} else if (M > '600') {
		// console.log("R");
		return '#FFB1B1';
	}

	// console.log(M);
}

function fuel(fuelid) {

	// console.log(fuelid);
	if (typeof fuelid !== 'undefined') {
		return fuelid;
	} else {
		return '';
	}
}

function license(licenseid) {

    console.log(M);
}

	if (licenseid !== null) {
		return licenseid;
	} else {

		return '';

	}
}

//click panto to marker
function myPanto(id, lat, lng) {
    map.setView([lat, lng], 16, {
        animate: true,
        noMoveStart: true
    });
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