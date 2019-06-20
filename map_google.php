<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>google map</title>
  <style media="screen">
    #map {
      width: 66.666vw;
      height: 90vh;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <script>

    // Initialize and add the map
    function initMap() {
      var uluru = {
        lat: 13.76498,
        lng: 100.538335
      };

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
      });

      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: 13.76498, lng: 100.538335}
      });
      marker.addListener('click', toggleBounce);


      var image = 'images/car.png';
        var beachMarker = new google.maps.Marker({
          position: {lat: 13.76498, lng: 100.538335},
          map: map,
          icon: image
        });

    }

    function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmgbn-fP3rkmLlbpv8wmMimvsmXqexD_o&callback=initMap"></script>
</body>
</html>
