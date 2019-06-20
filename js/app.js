var popup = L.popup();
var mymap = L.map('map').setView([13.76498, 100.538335], 18);

var OpenStreetMap_HOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
  maxZoom: 20,
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
}).addTo(mymap);

     var LeafIcon = L.Icon.extend({
          options: {
              iconSize: [100, 100],
              iconAnchor: [50, 50]
          }
      });

      var LeafIcon1 = L.Icon.extend({
          options: {
              iconSize: [29, 29],
              iconAnchor: [15, 15],
              popupAnchor: [0, -7]
          }
      });

      var greenIcon = new LeafIcon({iconUrl: 'images/mark_on2.png'}),
          redIcon = new LeafIcon1({iconUrl: 'images/van.png'});

    var m = L.marker([13.76498, 100.538335], {icon: greenIcon,rotationAngle: 360 ,rotationOrigin: 'center center'}).addTo(mymap);
    var m = L.marker([13.76498, 100.538335], {icon: redIcon}).addTo(mymap).bindPopup('Device : <br> Time : <br> Speed : <br> Address :');
    
 L.marker([13.76498, 100.538335])
  .bindLabel('ทะเบียนรถ', { noHide: true })
  .addTo(map);
