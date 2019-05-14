var map = L.map('map', {
  center: [18.635346666667, 99.044695],
  /*[18.795541, 98.986541],*/
  zoom: 20,
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
