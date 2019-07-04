var map = L.map('map', {
    center: [18.635346666667, 99.044695],
    zoom: 15,
    layers: [
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: 'Map data &copy; OpenStreetMap contributors',
        })
    ]
});