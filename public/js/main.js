$(document).ready(function () {
    $('#sinPermisoUbi').hide();
    $('#reload').hide();
    geolocalizacion();

    function geolocalizacion(){
        if(!!navigator.geolocation){
            $('#sinPermisoUbi').show();
            //Pedimos los datos de geolocalizacion al navegador
            navigator.geolocation.getCurrentPosition(
                    //Si el navegador entrega los datos de geolocalizacion los imprimimos
                    function (position){
                        $('#sinPermisoUbi').hide();
                        $('#reload').hide();
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;
                        document.getElementById('latitud').value = latitud;
                        document.getElementById('longitud').value = longitud;
                        setTimeout(function() {document.getElementById('fichar').disabled = false}, 500);
                        
                    },
                    //Si no los entrega manda un alerta de error
                    function () {
                        $('#reload').show();
                        var aviso = document.getElementById('sinPermisoUbi');
                        aviso.innerHTML = 'Es necesario activar la ubicación en su navegador y recargar la página';
                        aviso.display = 'block';
                    }
            )
        };
    }

    $("#fechaFichajes").change(function(){
        if(document.getElementById('fechaFichajes').value!=''){
            window.location.href = document.getElementById('fechaFichajes').value;
        }
      });

    if(document.getElementsByClassName('fichaje')){
        var fichajes = document.getElementsByClassName('fichaje');
        for (var i = 1; i < fichajes.length; i++) {
            if (i>=fichajes.length) fichajes[i].classList = 'fichaje pausa ultimo';
            else fichajes[i].classList = 'fichaje pausa';
            i++;
        }
    }
    function esconder(){
        if($("#status") != null) $('#status').hide();
    }
    setTimeout(esconder, 2500);

});

