

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Reverse Geocoding</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #floating-panel {
            position: absolute;
            top: 5px;
            left: 50%;
            margin-left: -180px;
            width: 350px;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
        }

        #latlng {
            width: 225px;
        }
    </style>
</head>
<style>
body{
  background-color: #666;
}

#barChart{
  background-color: wheat;
  border-radius: 6px;
/*   Check out the fancy shadow  on this one */
  box-shadow: 0 3rem 5rem -2rem rgba(0, 0, 0, 0.6);
}

</style>
<body>
    <div id="floating-panel">
        <input id="latlng" type="text" value="18.5769503,99.0084035">
        <input id="submit" type="button" value="Reverse Geocode">
    </div>
    <div id="map"></div>
    <script>
        //   function initMap() {
        //     var map = new google.maps.Map(document.getElementById('map'), {
        //       zoom: 8,
        //       center: {lat: 40.731, lng: -73.997}
        //     });

        //     var infowindow = new google.maps.InfoWindow;

        //     document.getElementById('submit').addEventListener('click', function() {
        //       geocodeLatLng(geocoder, map, infowindow);
        //     });
        //   }

        document.getElementById('submit').addEventListener('click', function() {
            geocodeLatLng();
        });
        // var latlngData = '18.5769503,99.0084035';
        function geocodeLatLng() {
            var geocoder = new google.maps.Geocoder;
            var service = new google.maps.places.PlacesService(latlng);
            var input = document.getElementById('latlng').value;
            var latlngStr = input.split(',', 2);
            var latlng = {
                lat: parseFloat(latlngStr[0]),
                lng: parseFloat(latlngStr[1])
            };


            geocoder.geocode({
                'location': latlng
            }, function(resultsaddr, statusaddr) {
                if (statusaddr === 'OK') {
                    if (resultsaddr[0]) {
                        //   map.setZoom(11);
                        console.log(resultsaddr);


                        geocoder.geocode({
                            'placeId': resultsaddr[0].place_id
                        }, function(resultsplace, statusplace) {
                            if (statusplace === 'OK') {
                                console.log(resultsplace);
                            }
                        });

                        // // place Detail
                        // service.getDetails(request, function(place, status) {
                        //     if (status === google.maps.places.PlacesServiceStatus.OK) {
                        //         var marker = new google.maps.Marker({
                        //             map: map,
                        //             position: place.geometry.location
                        //         });
                        //         google.maps.event.addListener(marker, 'click', function() {
                        //             infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                        //                 'Place ID: ' + place.place_id + '<br>' +
                        //                 place.formatted_address + '</div>');
                        //             infowindow.open(map, this);
                        //         });
                        //     }
                        // });


                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmgbn-fP3rkmLlbpv8wmMimvsmXqexD_o&libraries=places">
    </script>
</body>

</html>
