$(document).ready(function () {
    //Click al boton para pedir permisos
    /*$("#fichar").click(function () {
        $('#sinPermisoUbi').hide();
        $('#estado').show();
        $("#estado").text("Pendiente permisos de ubicación");
        //Si el navegador soporta geolocalizacion
        if (!!navigator.geolocation) {
            //Pedimos los datos de geolocalizacion al navegador
            navigator.geolocation.getCurrentPosition(
                    //Si el navegador entrega los datos de geolocalizacion los imprimimos
                    function (position) {
                        $('#sinPermisoUbi').hide();
                        $('#estado').show();
                        $("#estado").text("Fichando...");
                        //ENVIAMOS POST POR AJAX A ajax.php
                    
                        var xhttp = new XMLHttpRequest();
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;
                        var fecha = document.getElementById('fechaFichajes').value;
                        //variables que pasamos por la url
                        var params = `latitud=${latitud}&longitud=${longitud}&fecha=${fecha}`;
                        //Método, archivo php que lo gestiona y si es síncrona (false) o asíncrona (true)
                        xhttp.open("get", "fichar?"+ params, true);
                        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4){
                                if (this.status == 200) {
                                    $('#estado').hide();
                                    if($("#fichar").text()=='Entrar') $("#fichar").text("Salir");
                                    else{
                                        $("#fichar").text("Entrar");
                                    }
                                    console.log(fecha);
                                    console.log(latitud);
                                    console.log(longitud);
                                    //location.reload();
                                }
                                else $("#estado").text("Fichando...");
                            }
                        };
                        xhttp.send(params);
                    },
                    //Si no los entrega manda un alerta de error
                    function () {
                        $('#sinPermisoUbi').show();
                        $("#estado").text("");
                        $('#estado').hide();
                    }
            );
        }
    });*/

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

