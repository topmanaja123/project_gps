var map = L.map('map', {
    center: [18.635346666667, 99.044695],
    zoom: 15,
    
});

// Map Google 
var Streets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

var Hybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
      }).addTo(map);
      

    var Satellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

    
    // var Terrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
    // maxZoom: 20,
    // subdomains:['mt0','mt1','mt2','mt3']
    // }).addTo(map);
    
var basemaps = {
      'Streets': Streets,
      'Hybrid': Hybrid,
      'Satellite': Satellite,
    //   'Terrain': Terrain
    };


    L.control.layers(basemaps).addTo(map);

    var scale = L.control.scale().addTo(map);