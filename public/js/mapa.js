$(document).ready(function () {

    var latitudes = document.querySelectorAll('.latitudMapa');
    var longitudes = document.querySelectorAll('.longitudMapa');
    if (longitudes.length>0) {
        let map = L.map('map').setView([latitudes[0].innerHTML,longitudes[0].innerHTML],12.7)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        var icono = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
            iconSize: [40,40],
            iconAnchor: [20,40]
        });
    
        
        
        var coordenadas =[];
        for (let i = 0; i < latitudes.length; i++){
            coordenadas.push([latitudes[i].innerHTML,longitudes[i].innerHTML])
            if (i==0) {
                var inicio = L.marker([latitudes[i].innerHTML, longitudes[i].innerHTML],{icon:icono}).addTo(map);
                inicio.bindPopup("Inicio de jornada: "+ latitudes[i].id).openPopup();
            }
            else if (i==latitudes.length-1) {
                var fin = L.marker([latitudes[i].innerHTML, longitudes[i].innerHTML],{icon:icono}).addTo(map);
                fin.bindPopup("Fin de jornada: "+ latitudes[i].id);
            }
            else if(i%2!=0){
                var marker = L.marker([latitudes[i].innerHTML, longitudes[i].innerHTML],{icon:icono}).addTo(map);
                marker.bindPopup("Inicio descanso: "+ latitudes[i].id);
            }
            else{
                var marker = L.marker([latitudes[i].innerHTML, longitudes[i].innerHTML],{icon:icono}).addTo(map);
                marker.bindPopup("Fin descanso: "+ latitudes[i].id);
            }
        }
        var polyline = L.polyline(coordenadas, {color: 'black'}).addTo(map);
    }
    else{
        let map = L.map('map').setView([41.395264,2.174207],9)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    }

    $("#fechaFichajesInfoUsuario").change(function(){
        if(document.getElementById('fechaFichajesInfoUsuario').value!=''){
            var input = document.getElementById('fechaFichajesInfoUsuario');
            window.location.href = input.value;
        }
      });
    
});