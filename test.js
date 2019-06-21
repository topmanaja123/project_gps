/*
	Autor: Siim Ots
	Kontakt: info@gis.ee
	Kasutatud kaardid: maps.google.com, maps.here.com
	Kasutatud sõiduplaanid: transport.tallinn.ee
*/

// Kaardi info
window.L_PREFER_CANVAS = true;
var map = L.map('map', {
	maxBounds: [[59.30166, 24.49402],[59.60457, 25.02205]],
	zoomControl: L.Browser.mobile ? false : true,
	zoomSnap: L.Browser.mobile ? 0 : 1,
	zoomDelta: 1
});

var popupTimeout;

if (!map.restoreView()) {
	map.setView([59.43, 24.75], 13);
}

map.attributionControl.setPrefix('<a href="https://gis.ee" target="_blank">GIS.EE</a>');

map.on('contextmenu', function() { });

var realtime = L.realtime({
	url: 'geojson.php',
	type: 'json'
}, {
	interval: checkMobile('interval')
});

function checkMobile(type) {
	var check;
	if (screen.width <= 480) {
		check = true;
	} else {
		check = false;
	}

	if (typeof type === 'undefined') {
		return check;
	} else if (type == 'interval') {
		if (check) {
			return 10 * 1000;
		} else {
			return 5 * 1000;
		}
	} else if (type == 'markerRadius') {
		if (check) {
			return 11;
		} else {
			return 8;
		}
	} else if (type == 'soiduplaanidURL') {
		if (check) {
			return 'https://m.transport.tallinn.ee';
		} else {
			return 'https://transport.tallinn.ee';
		}
	}
}

// Kaardikiht
var google_kaart = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
	attribution: 'Data: <a href="https://transport.tallinn.ee/" target="_blank">Sõiduplaanid</a> | Map: <a href="https://maps.google.com" target="_blank">Google</a>',
	subdomains: ['mt0','mt1','mt2','mt3'],
	minZoom: 11,
	maxZoom: 20
});

var here_kaart = L.tileLayer('https://{s}.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/{z}/{x}/{y}/256/png8?app_id=WIb7udzZ2z84KKi3FVop&app_code=Heted_De8FPNX8-vdmjrsQ', {
	attribution: 'Data: <a href="https://transport.tallinn.ee/" target="_blank">Sõiduplaanid</a> | Map: <a href="https://developer.here.com" target="_blank">HERE</a>',
	subdomains: '1234',
	minZoom: 11,
	maxZoom: 20
}).addTo(map);

var tram_layer = new L.FeatureGroup().addTo(map);
var bus_layer = new L.FeatureGroup().addTo(map);
var trolleybus_layer = new L.FeatureGroup().addTo(map);
var stations_layer = new L.FeatureGroup().addTo(map);

var baseLayers = {
	'<img src="img/here.png"> HERE Maps': here_kaart,
	'<img src="img/google.png"> Google Maps': google_kaart
};

var overlays = {
	'<img src="img/buss.png"> Buss': bus_layer,
	'<img src="img/troll.png"> Troll': trolleybus_layer,
	'<img src="img/tramm.png"> Tramm': tram_layer,
	'<svg height="25" width="25"><circle cx="13" cy="18" r="6" stroke="black" stroke-width="1" fill="#ff7800" fill-opacity="0.8"/></svg> Peatused': stations_layer
};

L.control.layers(baseLayers, overlays, {
	collapsed: true
}).addTo(map);

// Ikoonid
var trollIco = L.icon({
	iconUrl: 'img/troll.png',
	iconSize: [25, 25]
});

var bussIco = L.icon({
	iconUrl: 'img/buss.png',
	iconSize: [25, 25]
});

var trammIco = L.icon({
	iconUrl: 'img/tramm.png',
	iconSize: [25, 25]
});

// Peatused
var geojsonMarkerOptions = {
	radius: checkMobile('markerRadius'),
	color: '#000',
	weight: 1,
	opacity: 1,
	fillColor: '#ff7800',
	fillOpacity: 0.8
};

// Allikas : http://stackoverflow.com/a/14991797 & http://jsfiddle.net/vHKYH/
function parseCSV(str) {
	var arr = [];
	var quote = false;
	for (row = 0, col = 0, c = 0; c < str.length; c++) {
		var cc = str[c], nc = str[c+1];
		arr[row] = arr[row] || [];
		arr[row][col] = arr[row][col] || '';
		if (cc == '"' && quote && nc == '"') { arr[row][col] += cc; ++c; continue; }
		if (cc == '"') { quote = !quote; continue; }
		if (cc == ',' && !quote) { ++col; continue; }
		if (cc == '\n' && !quote) { ++row; col = 0; continue; }
		arr[row][col] += cc;
	}
	return arr;
}

// Allikas : http://stackoverflow.com/a/6313008
String.prototype.toHHMM = function () {
	var sec_num = parseInt(this, 10);
	var hours = Math.floor(sec_num / 3600);
	var minutes = Math.floor((sec_num - (hours * 3600)) / 60);

	if (hours < 10) hours = '0' + hours;
	if (minutes < 10) minutes = '0' + minutes;

	if (hours == 24) hours = '00';
	var time = hours + ':' + minutes;

	return time;
};

var peatusedgeojson = L.geoJson(peatused, {
	pointToLayer: function (feature, latlng) {
		return L.circleMarker(latlng, geojsonMarkerOptions);
	},
	onEachFeature: onEachFeature
}).addTo(stations_layer);

var aeg = new Date().getTime();

function onEachFeature(feature, layer) {
	function makeRequest(url) {
		httpRequest = new XMLHttpRequest();

		if (!httpRequest) {
			console.log('Error httpRequest...');
			return false;
		}

		httpRequest.onreadystatechange = getTimetable;
		httpRequest.open('GET', url, true);
		httpRequest.send();
	}

	function getTimetable() {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
			if (httpRequest.status === 200) {
				if (httpRequest.responseText.indexOf('ERROR') !== -1) {
					console.log('Error getTimetable...', httpRequest.responseText);
					return layer.bindPopup('<h2>' + feature.properties.Name + '</h2>');
				}

				var sisu = parseCSV(httpRequest.responseText);
				var nimetus = '<h2>' + feature.properties.Name + '</h2>';
				var tulemus = nimetus +
					'<div class="tabel"><table>' +
					'<tr>' +
					'<th>Liik</th>' +
					'<th>Nr</th>' +
					'<th>Väljub</th>' +
					'<th>Suund</th>' +
					'<th></th>' +
					'<th></th>' +
					'</tr>';

				for (var i = 2; i <= sisu.length - 1; i++) {
					if (sisu[i][0] === 'trol') {
						liik = 'troll';
					} else if (sisu[i][0] === 'bus') {
						liik = 'buss';
					} else if (sisu[i][0] === 'tram') {
						liik = 'tramm';
					}

					tulemus += '<tr>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/" target="_blank"><img src="img/' + liik + '.png"></a></td>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/' + sisu[i][1] + '" target="_blank">' + sisu[i][1] + '</a></td>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/' + sisu[i][1] + '" target="_blank">' + sisu[i][3].toHHMM() + '</a></td>';
					tulemus += '<td>' + sisu[i][4] + '</td>';
					if (sisu[i][2] - sisu[i][3] < -30) {
						tulemus += '<td><img src="img/early.png" alt="Jõuab varem" title="Jõuab ' + Math.abs(sisu[i][2] - sisu[i][3]) + 's varem">' + '</td>';
						tulemus += '<td>-' + Math.abs(sisu[i][2] - sisu[i][3]) + 's</td>';
					} else if (sisu[i][2] - sisu[i][3] > 30) {
						tulemus += '<td><img src="img/late.png" alt="Hilineb" title="Hilineb ' + Math.abs(sisu[i][2] - sisu[i][3]) + 's">' + '</td>';
						tulemus += '<td>+' + Math.abs(sisu[i][2] - sisu[i][3]) + 's</td>';
					} else {
						tulemus += '<td> </td><td> </td>';
					}
					tulemus += '</tr>';
				}

				tulemus += '</table></div>';
				tulemus = sisu.length > 1 ? tulemus : nimetus;

				return layer.bindPopup(tulemus);
			} else {
				console.log('Error getTimetable...');
			}
		}
	}

	layer.on({
		mouseover: function() {
			clearTimeout(popupTimeout);
			if (!checkMobile()) {
				var that = this;
				popupTimeout = setTimeout(function () {
					layer.bindPopup('<h2>Laen andmeid...</h2>');
					that.openPopup();
					var SiriID = feature.properties.SiriID;
					var paring = 'https://transport.tallinn.ee/siri-stop-departures.php?stopid=' + SiriID;
					makeRequest(paring);
				}, 300);
			}
		},
		mouseout: function() {
			clearTimeout(popupTimeout);
		},
		click: function() {
			clearTimeout(popupTimeout);
			layer.bindPopup('<h2>Laen andmeid...</h2>');
			var SiriID = feature.properties.SiriID;
			var paring = 'https://transport.tallinn.ee/siri-stop-departures.php?stopid=' + SiriID;
			makeRequest(paring);
		}
	});
}

// Live funktsioonid
realtime.on('update', function(e) {
	var popupContent = function(fId) {
		var feature = e.features[fId];
		var id = feature.properties.id;
		var type = feature.properties.type;
		var line = feature.properties.line;
		var direction = feature.properties.direction;
		var coordinates = feature.geometry.coordinates;
		var url = checkMobile('soiduplaanidURL');

		if (type === 1) {
			type = 'trolleybus';
			url += '/#trol/';
		} else if (type === 2) {
			type = 'bus';
			url += '/#bus/';
		} else if (type === 3) {
			type = 'tram';
			url += '/#tram/';
		}

		if (line > 0) url += line;

		var link = '<a href="' + url + '" class="' + type + '" target="_blank">' + line + '</a>';

		return '<p class="marker-info ' + type + '">' + link + ' ' +
			'<img src="img/arrow.png" class="direction" alt="direction" style="transform: rotate(' + direction + 'deg)"></p>';
	};

	var bindFeaturePopup = function(fId) {
		var feature = realtime.getLayer(fId);
		var properties = e.features[fId].properties;

		if (properties.line === 0) {
			feature.setOpacity(0.5);
		}

		if (properties.direction >= 0 && properties.direction <= 360) {
			feature.setRotationAngle(properties.direction).setRotationOrigin('center center');
		}

		feature.bindPopup(popupContent(fId));

		if (properties.type === 1) {
			feature.setIcon(trollIco).addTo(trolleybus_layer);
		} else if (properties.type === 2) {
			feature.setIcon(bussIco).addTo(bus_layer);
		} else if (properties.type === 3) {
			feature.setIcon(trammIco).addTo(tram_layer);
		}

		if (checkMobile()) {
			feature.on('click', function(e){
				clearTimeout(popupTimeout);
				this.openPopup();
			});
		} else {
			feature.on('mouseover', function(e){
				clearTimeout(popupTimeout);
				var that = this;
				popupTimeout = setTimeout(function () { that.openPopup(); }, 300);
			});
			feature.on('mouseout', function(e){
				clearTimeout(popupTimeout);
			});
		}
	};

	var updateFeaturePopup = function(fId) {
		var feature = realtime.getLayer(fId);
		var properties = e.features[fId].properties;

		if (properties.direction >= 0 && properties.direction <= 360) {
			feature.setRotationAngle(properties.direction).setRotationOrigin('center center');
		}
		feature.setPopupContent(popupContent(fId));
	};

	Object.keys(e.enter).forEach(bindFeaturePopup);
	Object.keys(e.update).forEach(updateFeaturePopup);
});

//if (L.Browser.mobile) realtime.stop();

if (window.location.search === '?live=0') {
	realtime.stop();
}
if (window.location.search === '?live=1') {
	realtime.start();
}

var searchControl = new L.Control.Search({
	layer: peatusedgeojson,
	propertyName: 'Name',
	zoom: 17,
	autoCollapse: true,
	hideMarkerOnCollapse: true,
	marker: {
		icon: false,
		animate: false
	}
}).on('search:locationfound', function(e) {
	var feature = e.layer.feature;
	var layer = e.layer;

	function makeRequest(url) {
		httpRequest = new XMLHttpRequest();

		if (!httpRequest) {
			console.log('Error httpRequest...');
			return false;
		}

		httpRequest.onreadystatechange = getTimetable;
		httpRequest.open('GET', url, true);
		httpRequest.send();
	}

	function getTimetable() {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
			if (httpRequest.status === 200) {
				if (httpRequest.responseText.indexOf('ERROR') !== -1) {
					console.log('Error getTimetable...', httpRequest.responseText);
					return layer.bindPopup('<h2>' + feature.properties.Name + '</h2>');
				}

				var sisu = parseCSV(httpRequest.responseText);
				var nimetus = '<h2>' + feature.properties.Name + '</h2>';
				var tulemus = nimetus +
					'<div class="tabel"><table>' +
					'<tr>' +
					'<th>Liik</th>' +
					'<th>Nr</th>' +
					'<th>Väljub</th>' +
					'<th>Suund</th>' +
					'<th></th>' +
					'<th></th>' +
					'</tr>';

				for (var i = 2 ; i <= sisu.length - 1; i++) {
					if (sisu[i][0] === 'trol') {
						liik = 'troll';
					} else if (sisu[i][0] === 'bus') {
						liik = 'buss';
					} else if (sisu[i][0] === 'tram') {
						liik = 'tramm';
					}

					tulemus += '<tr>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/" target="_blank"><img src="img/' + liik + '.png"></a></td>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/' + sisu[i][1] + '" target="_blank">' + sisu[i][1] + '</a></td>' +
						'<td><a href="' + checkMobile('soiduplaanidURL') + '/#' + sisu[i][0] + '/' + sisu[i][1] + '" target="_blank">' + sisu[i][3].toHHMM() + '</a></td>';
					tulemus += '<td>' + sisu[i][4] + '</td>';
					if (sisu[i][2] - sisu[i][3] < -30) {
						tulemus += '<td><img src="img/early.png" alt="Jõuab varem" title="Jõuab ' + Math.abs(sisu[i][2] - sisu[i][3]) + 's varem">' + '</td>';
						tulemus += '<td>-' + Math.abs(sisu[i][2] - sisu[i][3]) + 's</td>';
					} else if (sisu[i][2] - sisu[i][3] > 30) {
						tulemus += '<td><img src="img/late.png" alt="Hilineb" title="Hilineb ' + Math.abs(sisu[i][2] - sisu[i][3]) + 's">' + '</td>';
						tulemus += '<td>+' + Math.abs(sisu[i][2] - sisu[i][3]) + 's</td>';
					} else {
						tulemus += '<td> </td><td> </td>';
					}
					tulemus += '</tr>';
				}

				tulemus += '</table></div>';
				tulemus = (sisu.length > 1 ? tulemus : nimetus);

				return layer.bindPopup(tulemus);
			} else {
				console.log('Error getTimetable...');
			}
		}
	}
	layer.bindPopup('<h2>Laen andmeid...</h2>');
	layer.openPopup();
	var SiriID = feature.properties.SiriID;
	var paring = 'https://transport.tallinn.ee/siri-stop-departures.php?stopid=' + SiriID;
	makeRequest(paring);
});

map.addControl(searchControl);

var liveControl = L.Control.extend({
	options: {
		position: 'topleft'
	},

	onAdd: function (map) {
		var container = L.DomUtil.create('div', 'leaflet-control-zoom leaflet-bar');
		if (realtime.isRunning()) {
			container.innerHTML = '<a href="#" title="Live" role="button" aria-label="Live">⏩</a>';
		} else {
			container.innerHTML = '<a href="#" title="Not Live" role="button" aria-label="Not Live">⏹️</a>';
		}
		container.onclick = function(){
			if (realtime.isRunning()) {
				container.innerHTML = '<a href="#" title="Not Live" role="button" aria-label="Not Live">⏹️</a>';
				realtime.stop();
			} else {
				container.innerHTML = '<a href="#" title="Live" role="button" aria-label="Live">⏩</a>';
				realtime.start();
			}
		};
		return container;
	}
});

map.addControl(new liveControl());

function onLocationFound(e) {
	map.setView(e.latlng);

	if (map.getZoom() < 15) map.setZoom(15);

	var marker = L.circle(e.latlng, {
		radius: e.accuracy / 2
	});

	marker.addTo(map);

	setTimeout(function() {
		if (marker) map.removeLayer(marker);
	}, 2.5 * 1000);
}

map.on('locationfound', onLocationFound);

function onLocationError() {
	alert('Asukohta ei leitud!');
}

map.on('locationerror', onLocationError);

var locationControl = L.Control.extend({
	options: {
		position: 'topleft'
	},

	onAdd: function (map) {
		var container = L.DomUtil.create('div', 'leaflet-control-zoom leaflet-bar');
		container.innerHTML = '<a href="#" title="GPS" role="button" aria-label="GPS">📍</a>';
		container.onclick = function(){
			map.locate({ watch: false, enableHighAccuracy: true });
		};

		return container;
	}
});

map.addControl(new locationControl());
