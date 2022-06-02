$(document).ready(function () {
 
    (function ($) {
 
        $('#filtrar').keyup(function () {
            var texto = $('#filtrar').val();
            var usuarios = document.querySelectorAll('div');
            usuarios.forEach(usuario => {
                if(usuario.id =='UsuarioLista'){

                    var spans = usuario.querySelectorAll('span p');
                    spans.forEach(span => {
                        var name = span.innerHTML.toLocaleLowerCase();
                        if(!name.includes(texto.toLocaleLowerCase())){
                            usuario.style.display = 'none';
                        }
                        else usuario.style.display = 'flex';
                    });
                }
            });
 
        })
 
    }(jQuery));
 
    function esconder(){
        if($("#status") != null) $('#status').hide();
    }
    setTimeout(esconder, 4000);

});