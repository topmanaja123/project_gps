<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- map -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>

	<!-- marker -->
	<script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>

	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/leaflet-realtime.js"></script>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<title>Document</title>
	<style>
		.table {
			font-size: 14px;
		}
	</style>
</head>
<script>
	function getDataFromDb() {
		$.ajax({
			url: "getPositions.php",
			type: "POST",
			data: "result",
			success: function(result) {
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
						tr = tr + "<td>" + val["CustomerID"] + "</td>";
						tr = tr + "<td>" + val["devi_name"] + "</td>";
						tr = tr + "<td>" + val["Email"] + "</td>";
						tr = tr + "<td>" + val["CountryCode"] + "</td>";
						tr = tr + "<td>" + val["Budget"] + "</td>";
						tr = tr + "<td>" + val["Used"] + "</td>";
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
						send();
					});
				}
			}
		});
	}
	setInterval(getDataFromDb, 5000); // 1000 = 1 second

	var data2 = '';

	function send() {
		var json = data2;
		$.ajax({
			url: "jsonData.php",
			type: "POST",
			data: json,
			success: function(data) {
				console.log(json);
				// alert(data);
			}
		});
	};
</script>

<body>
	<div class="form-row">
		<div class="table-responsive col-md-3 col-sm-6">
			<table class="table  table-bordered table-striped table-hover table-sm" id="myTable">
				<thead>
					<tr>
						<td width="91">
							<div align="center">CustomerID</div>
						</td>
						<td width="98">
							<div align="center">Name</div>
						</td>
						<td width="198">
							<div align="center">Email</div>
						</td>
						<td width="97">
							<div align="center">CountryCode</div>
						</td>
						<td width="59">
							<div align="center">Budget</div>
						</td>
						<td width="71">
							<div align="center">Used</div>
						</td>
					</tr>
				</thead>
				<!-- body dynamic rows -->
				<tbody id="myBody" style="cursor:pointer;">

				</tbody>
			</table>

		</div>
		<div class="col-9">
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
			L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
				maxZoom: 20,
				attribution: 'Map data &copy; OpenStreetMap contributors',
			})

		]
	});

	//zoom add a scale at at your map.
	var scale = L.control.scale().addTo(map);

	//realtime json
	var realtime = L.realtime({
		url: 'json/data.json',
		crossOrigin: true,
		type: 'json'
	}, {
		interval: 3 * 1000,
		pointToLayer: function(feature, latlng) {
			return L.marker(latlng, {
				'icon': L.icon({
					iconUrl: 'images/truck.png',
					iconSize: [50, 50],
					iconAnchor: [25, 25],
					popupAnchor: [0, -20],
					autoPan: false
				})
			});
			animate: true
		}
	}).addTo(map);
	//Detail Marker
	realtime.on('update', function(e) {
		popupContent = function(fId) {
				var feature = e.features[fId];
				var c_name = feature.properties.id;
				var content = feature.content.devi_name;
				var c_servertime = feature.content.servertime;

				return 'Detail <br>' + 'Name = ' + content + '<br> Time = ' + c_servertime;
			},
			bindFeaturePopup = function(fId) {
				realtime.getLayer(fId).bindPopup(popupContent(fId));
			},
			updateFeaturePopup = function(fId) {
				realtime.getLayer(fId).getPopup().setContent(popupContent(fId));
			},
			click = function(fId) {
				realtime.getLayer(fId).onclick(fId);
			};
		Object.keys(e.enter).forEach(bindFeaturePopup);
		Object.keys(e.update).forEach(updateFeaturePopup);
	});

	//คลิก Marker Zoom
	map.on('popupopen', function(centerMarker) {
		var cM = map.project(centerMarker.popup._latlng);
		cM.y -= centerMarker.popup._container.clientHeight /
			map.setView(map.unproject(cM), 20, {
				markerZoomAnimation: true
			});
	});
</script>