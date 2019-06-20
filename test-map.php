<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>OpenLaye</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<script type='text/javascript' src='http://www.openlayers.org/api/OpenLayers.js'>     </script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<link rel="stylesheet" href="ol.css" type="text/css">
</head>

<body>

<div id="map" class="smallmap"></div>

    <script>
    //Defining projections
        var geographic = new OpenLayers.Projection("EPSG:4326");
        var mercator = new OpenLayers.Projection("EPSG:900913");

    //Defining bounds
        var world = new OpenLayers.Bounds(-180, -89, 180, 89).transform(
            geographic, mercator
        );
    //Defining map center
        var lund_center = new OpenLayers.LonLat(98.3, 8).transform(
            geographic, mercator
        );

        var options = {
            projection: mercator,
            displayProjection: geographic,
            units: "m",
            maxExtent: world,
            maxResolution: 156543.0399,

        };
    //Defining main variables
        var map = new OpenLayers.Map("map", options, { controls: [] });

        var gsat = new OpenLayers.Layer.Google(
        "Google Satellite",
        {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22}

    );
    map.addLayer(gsat);

        var gmap = new OpenLayers.Layer.Google(

        "Google Streets",
        {type: google.maps.MapTypeId.Streets,numZoomLevels: 20}
    );
    map.addLayer(gmap);


    //List of layers
        var Tambon = new OpenLayers.Layer.WMS(
            "Tambon",
            "http://localhost:8080/geoserver/sattawat/wms",

            {
                layers: "sattawat:SubDistrict",
                transparent: "true",
                format: "image/png"
            },
            {isBaseLayer: false, visibility: true}
        );
        map.addLayer(Tambon);
        ///////////////////////////////////////


    //Map center and zoom
        map.setCenter(lund_center, 8);

    //List of controls
        map.addControl(new OpenLayers.Control.LayerSwitcher());

        


    </script>


</body>
</html>
