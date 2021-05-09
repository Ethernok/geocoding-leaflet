function cargar(div, desde){$(div).load(desde);}
var map = L.map('map', {
    zoomDelta: 0.25,
    zoomSnap: 0
});
var marker_actual;       
var browserLat;
var browserLong;  
var direccion;
var circulo;
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',maxZoom: 18}).addTo(map);


map.locate({setView: true, maxZoom: 18});

function onLocationFound(e) {
 var radius = e.accuracy / 2;
 var geocodeService = L.esri.Geocoding.geocodeService();
 geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
        let dir = document.getElementById('direccion');
        marker_actual=L.marker(e.latlng).addTo(map);
        marker_actual.bindPopup(`Estas aquí, con ${radius} metros de aproximación`).openPopup();
        
        
             
    });
 }
 
 function onLocationError(e) {
 alert(e.message);
}

    
 map.on('locationfound', onLocationFound);

// ---------------Geo Inversa-------------------


var geocodeService = L.esri.Geocoding.geocodeService(
  //{apikey: apiKey}
  );

map.on('click', function (e) {
  $('.leaflet-marker-icon').remove();
  $('.leaflet-marker-shadow').remove();
  geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
    if (error) {
      return;
    }

    L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
    map.setView(result.latlng,15)
    $('#direccion').val(result.address.Match_addr)
    
  });
});

// ---------------------------------------------
 $('#buscar').on('click',function(){
    let dir2 = document.getElementById('direccion'); 
    var direc=dir2.value;
    L.esri.Geocoding.geocode({
        requestParams: {
          maxLocations: 1
        }
      })
        .text(direc)
        .run(function(error, results, response) {
          var mlat=results.results[0].latlng.lat;
          var mlon=results.results[0].latlng.lng;
          var radius2 = 10;
          map.setView([mlat,mlon], 18);
          marker_actual=L.marker([mlat,mlon]).addTo(map);
          marker_actual.bindPopup(`El pedido está aquí: ${direc} `).openPopup();
          
        });  
    });
    $('#nuevo-pedido').on('click',function(){
      let dir2 = document.getElementById('direccion'); 
      var direc=dir2.value;
      L.esri.Geocoding.geocode({
          requestParams: {
            maxLocations: 1
          }
        })
          .text(direc)
          .run(function(error, results, response) {
            var mlat=results.results[0].latlng.lat;
            var mlon=results.results[0].latlng.lng;
            var radius2 = 10;
            map.setView([mlat,mlon], 18);
            marker_actual=L.marker([mlat,mlon]).addTo(map);
            marker_actual.bindPopup(`El pedido está aquí: ${direc} `).openPopup();
            
          });  
      });