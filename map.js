
var basemaps = {
  'Streets' : L.tileLayer("http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
    maxZoom: 20,
    subdomains: ["mt0", "mt1", "mt2", "mt3"]
  }),
  'Hybrid' : L.tileLayer(
    "http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}",
    {
      maxZoom: 20,
      subdomains: ["mt0", "mt1", "mt2", "mt3"]
    }),
    'Satellite' : L.tileLayer(
      "http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"]
      })
  //   'Terrain': Terrain
};

var map = L.map("map", {
  center: [18.635346666667, 99.044695],
  zoom: 20,
  layers: [
    basemaps.Streets
  ]
});

L.control.layers(basemaps).addTo(map);

var scale = L.control.scale().addTo(map);


